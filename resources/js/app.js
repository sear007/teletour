import './bootstrap';
import { createApp } from 'vue';
const app = createApp({});

import ExampleComponent from './components/ExampleComponent.vue';

//Branch
import BanchBanner from './components/branch/Banner.vue';
import GridPhotos from './components/branch/GridPhotos.vue';
import MiniMap from './components/branch/MiniMap.vue';
import ModalDetail from './components/branch/ModalDetail.vue';
import ModalReservation from './components/branch/ModalReservation.vue';
import RoomCard from './components/branch/RoomCard.vue';
import Stepper from './components/branch/Stepper.vue';
app.component('example-component', BanchBanner);


// Module Branch
app.component('branch-banner', Banner);
app.component('branch-grid-photos', GridPhotos);
app.component('branch-modal-detail', ModalDetail);
app.component('branch-modal-reservation', ModalReservation);
app.component('branch-room-card', RoomCard);
app.component('branch-stepper', Stepper);

app.mount('#app');
