<template>
	<div>
		<qrcode-stream @decode="onDecode"></qrcode-stream>

		<loading
			:show="loading"
		></loading>


		<modal
			:bodyMessage="modalMessage"
			:headerTitle="modalTitle"
			:show="showModal"
			@closeModal="showModal = false"
		></modal>
	</div>
</template>
<script type="text/javascript">
	import { QrcodeStream, QrcodeDropZone, QrcodeCapture } from 'vue-qrcode-reader'
	import Loading from './Loading.vue';
	import Modal from './Modal.vue';

	export default {
		name: 'QrScanner',

		data() {
			return {
				loading: false,
				modalMessage: '',
				modalTitle: '',
				showModal: false,
			}
		},
		
		components: {
		    QrcodeStream,
		    QrcodeDropZone,
		    QrcodeCapture,
			Loading,
		    Modal,
		},

		methods: {
			onDecode (decodedString) {
				this.loading = true;
			    axios.get(decodedString)
			    	.then(response => {
			    		this.loading = false;
			    		this.modalTitle = 'QR Scanned';
			    		this.modalMessage = 'Passenger ticket is validated. Ticket is now boarded.';
			    		this.showModal = true;
			    	}).catch((errors) => {
			    		this.loading = false;
			    		this.modalTitle = 'Ooops';
			    		this.modalMessage = 'QR is not validated.';
			    		this.showModal = true;
			    	})
		  	}
		}

	}
</script>