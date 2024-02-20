<template>

    <div>
      <button @click="initScanner">Enable Camera</button>
    
      <qrcode-stream 
        v-if="cameraEnabled"
        @init="onInit" 
        @decode="onDecode"
      />
    </div>
  
  </template>
  
  
  <script>
  import { QrcodeStream } from 'vue-qrcode-reader'

    export default {

    components: {
        QrcodeStream
    },
    mounted(){
        this.$qrcodeStream;
    },  
    
    data() {
    return {
        cameraEnabled: false
    }
    },
  
    methods: {
  
        async initScanner() {
        try {
            await this.$qrcodeStream.initiate();
            this.cameraEnabled = true;
                
        } catch (error) {
            if (error.name === 'NotAllowedError') {
            alert('Camera permission required');
            } else {
            console.error(error);
            }
        }
        },

        onInit(promise) {
        promise.then(() => console.log('Scanner ready!'));
        },

        onDecode(result) {
        console.log('Scanned:', result);
        }

    }
    }
    </script>