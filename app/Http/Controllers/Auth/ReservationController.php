<?php

namespace App\Http\Controllers\Auth;

use App\Events\SendInvoiceEvent;
use App\Events\SendReceiptEvent;
use App\Http\Controllers\Controller;
use App\Http\Resources\RoomTypeResource;
use App\Models\Reservation;
use App\Models\RoomType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Str;

class ReservationController extends Controller
{
    public function test(){
        return env('ABA_PAYWAY_API_KEY');
        $payment = Reservation::Information('tele-81')->first();
        return view('pages.checkout.receipt', compact('payment'));
    }
    
    public function index(Request $request)
    {
        $room = $this->roomDetail(request('room_id'));
        $step = $this->getStep();
        return view('pages.checkout.index')
            ->with(compact(
                'room',
                'step',
            ));
    }

    public function checkout(Request $request)
    {
        $data = $request->except(['roomPrice']);
        $data['payment_status'] = 'pending';
        $data['price'] = $this->getTotalPrice($request->all());
        $data['user_app_id'] = auth()->user()->id;
        $data['tran_id'] = getUniqueTranId();
        $data['req_time'] = date('YmdHisu');
        $data['hashData'] = getHashData($data);
        $data['hash'] = getHash($data['hashData']);
        try {
            $payment = Reservation::create($data);
            $payment['branch'] = $payment->branch();
            $payment['room'] = $payment->roomType();
            event(new SendInvoiceEvent($payment));
            return response()->json([
                'success' => true,
                'data' => $payment->tran_id,
            ]);
        } catch (\Throwable $th) {
            dd($th);
            return response()->json([
                'success' => false,
                'error'=> $th,
            ]);
        }
    }

    public function checkoutStatus(Request $request)
    {
        $data = $request->all();
        $data['merchant_id'] = env('ABA_PAYWAY_MERCHANT_ID');
        $result = checkPaymentStatus($data);
        if ($result['description'] === 'approved') {
            $payment = Reservation::whereTranId($data['tran_id'])->first();
            $payment->payment_status = 'approved';
            $payment->update();
        }
        return $result;
    }

    public function sendReceipt($tran_id){
        $payment = $this->roomReservation($tran_id);
        event(new SendReceiptEvent($payment));
    }

    public function getPdf($tran_id)
    {
        $payment = $this->roomReservation($tran_id);
        $pdf = Pdf::loadView('pages.checkout.invoice', compact('payment'));
        return $pdf->download('invoice.pdf');
    }

    public static function roomDetail($id)
    {
        $room = RoomType::find($id);
        return new RoomTypeResource($room);
    }

    public function roomReservation($tran_id)
    {
        $reservation = Reservation::information($tran_id)->first();
        return $reservation;
    }

    public static function getStep()
    {
        try {
            if (request('hotel_id') && request('room_id') && request('tran_id')) {
                $step = 3;
            } else if (request('hotel_id') && request('room_id')) {
                $step = 2;
            } else if (request('hotel_id')) {
                $step = 1;
            }
            return $step;
        } catch (\Throwable $th) {
            return 1;
        }
    }

    public function getNumberOfStay($date_from, $date_to)
    {
        try {
            $startDate = Carbon::parse($date_from);
            $endDate = Carbon::parse($date_to);

            return $endDate->diffInDays($startDate);
        } catch (\Throwable $th) {
            return 0;
        }
    }

    public function getTotalPrice($data)
    {
        $room = $this->roomDetail($data['room_type_id']);
        $lengthStaty = $this->getNumberOfStay($data['date_from'], $data['date_to']);
        $lengthRoom = $data['num_rooms'];
        $price = ($room->price * $lengthStaty) * $lengthRoom;
        return $price;
    }
}
