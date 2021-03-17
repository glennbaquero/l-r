<template>
	<!-- Slider main container -->
    <div class="swiper-container h-full">
        <!-- Additional required wrapper -->
        <div class="swiper-wrapper">
            <!-- Slides -->
            <div class="swiper-slide" v-for="item in items">
            	<h4 class="font-bold text-center text-xl">{{ item.name }}</h4>
            	<iframe :width="items.length != 1 ? '100%' : '50%'" :class="items.length == 1 ? 'mx-auto' : '' " height="80%" :src="item.source" v-if="item.from_youtube" allowfullscreen> </iframe>
            	<iframe width="100%" height="80%" :src="item.full_path" v-if="!item.from_youtube" allowfullscreen> </iframe>
            <!-- 	<video width="100%" height="80%" class="max-w-min h-36" controls v-if="!item.from_youtube">
            		<source :src="item.full_path" type="video/mp4">
        			Your browser does not support the video tag.
            	</video> -->
            	<blockquote class="mt-8 md:flex-grow md:flex md:flex-col" >
	            	<div class="relative block font-medium text-sm text-gray-700 md:flex-grow" :class="items.length == 1 ? 'mx-auto' : '' ">
	            	  	<svg class="absolute top-0 left-0 transform -translate-x-3 -translate-y-2 h-4 w-4 text-black-600" fill="currentColor" viewBox="0 0 32 32">
	            	   	 	<path d="M9.352 4C4.456 7.456 1 13.12 1 19.36c0 5.088 3.072 8.064 6.624 8.064 3.36 0 5.856-2.688 5.856-5.856 0-3.168-2.208-5.472-5.088-5.472-.576 0-1.344.096-1.536.192.48-3.264 3.552-7.104 6.624-9.024L9.352 4zm16.512 0c-4.8 3.456-8.256 9.12-8.256 15.36 0 5.088 3.072 8.064 6.624 8.064 3.264 0 5.856-2.688 5.856-5.856 0-3.168-2.304-5.472-5.184-5.472-.576 0-1.248.096-1.44.192.48-3.264 3.456-7.104 6.528-9.024L25.864 4z" />
	            	  	</svg>
	            	  	<p class="relative">
	            	    	{{ item.description }}
	            	  	</p>
	            	</div>
		      </blockquote>
            </div>
        </div>

        <!-- If we need navigation buttons -->
        <!-- <div class="swiper-button-prev"></div> -->
        <!-- <div class="swiper-button-next"></div> -->
    </div>
</template>
<script type="text/javascript">

import Swiper from 'swiper';
import 'swiper/swiper-bundle.css';

export default {
	name: 'Slider',

	props: {
		items: Array
	},

	mounted() {

		var options = {};

		if (this.items.length > 1 ) {
		       options = {
	           	  	// Optional parameters
	           	  	direction: 'horizontal',
	           	  	loop: true,
	           	  	slidesPerView: 3,
	               	spaceBetween: 30,

	           	  	autoplay: {
	           	   		delay: 2000,
	           	 	},

	           	  // // Navigation arrows
	           	  // navigation: {
	           	  //   nextEl: '.swiper-button-next',
	           	  //   prevEl: '.swiper-button-prev',
	           	  // },
		       }
		   } else {
		       options = {
		           loop: false,
		           autoplay: false,
	           	  	direction: 'horizontal',
		       }
		   }
		new Swiper('.swiper-container', options);
	}
}

</script>