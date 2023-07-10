<script>
export default {
    name: 'SiteCarousel',
    data() {

        return {
            images: [
                "/src/assets/images/3b87fafb93f0e3600081301ef6a812c9.jpg",
                "/src/assets/images/pexels-quang-nguyen-vinh-2131772.jpg",
                "/src/assets/images/8571478032_ca4f083630_b.jpg",
                "/src/assets/images/casa-in-montagna-moderna-da-pinterest.jpg",
                "/src/assets/images/cassetta_view_cs_large_gallery_preview.jpg",
                "/src/assets/images/cottage.jpg",
                "/src/assets/images/casa-montagna-moderna-design.jpg",
            ],
            currentIndex: 0,
        }

    },
    methods: {
        startCarousel() {
            setInterval(() => {
                this.nextImage();
            }, 8000);
        },
        nextImage() {
            this.currentIndex = (this.currentIndex + 1) % this.images.length;
        },
    },
    computed: {
        currentImage() {
            return this.images[this.currentIndex];
        },
    },

    mounted() {
        this.startCarousel();
    }
}
</script>
<template>
    <div class="image_container px-0 px-sm-4 position-relative">
        <img :key="currentImage" :src="currentImage" class=" jumbo_tron_img carousel-image " />
        <!-- <img :key="currentImage" :src="currentImage" class=" jumbo_tron_img carousel-image2 " /> -->
    </div>
</template>


<style lang="scss" scoped>
// .carousel {
//     width: 100%;
//     height: 400px;
//     position: relative;
// }
// .carousel-image2 {
//     position: absolute;
//     left: 0;
//     padding: 16px;
// }

// .carousel-image {

//     left: 0;

// }

.carousel-image {
    animation: fade_in 2s linear;
    // animation: fade_out 1s linear 6s;

}

@keyframes fade_in {
    from {
        opacity: 0;
    }

    to {
        opacity: 1;
    }
}

@keyframes fade_out {
    from {
        opacity: 1;
    }

    to {
        opacity: 0;
    }
}
</style>