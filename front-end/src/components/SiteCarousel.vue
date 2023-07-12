<script>
export default {
    name: 'SiteCarousel',
    data() {

        return {
            images: [
                "/src/assets/images/3b87fafb93f0e3600081301ef6a812c9.jpg",
                "/src/assets/images/8571478032_ca4f083630_b.jpg",
                "/src/assets/images/casa-in-montagna-moderna-da-pinterest.jpg",
            ],
            images2: [
                "/src/assets/images/casa-montagna-moderna-design.jpg",
                "/src/assets/images/cassetta_view_cs_large_gallery_preview.jpg",
                "/src/assets/images/cottage.jpg",
                "/src/assets/images/pexels-quang-nguyen-vinh-2131772.jpg",
            ],
            currentIndex: 0,
            currentIndex2: 0,
            animation: false,
            animation2: false
        };
    },
    methods: {
        startCarousel() {
            this.animation = true;
            setInterval(() => {
                this.nextImage();
            }, 16000);
        },
        startSecondCarousel() {

            setTimeout(() => {
                this.animation2 = true;
                setInterval(() => {
                    this.nextImage2();
                }, 16000);
            }, 7000);
        },
        nextImage() {
            this.currentIndex = (this.currentIndex + 1) % this.images.length;
        },
        nextImage2() {
            this.currentIndex2 = (this.currentIndex2 + 1) % this.images2.length;
        },
    },
    computed: {
        currentImage() {
            return this.images[this.currentIndex];
        },
        currentImage2() {
            return this.images2[this.currentIndex2];
        },
    },
    mounted() {
        this.startCarousel();
        this.startSecondCarousel();
    },
};

</script>
<template>
    <div class="carousel_container image_container px-0 px-sm-4 w-100 position-relative end-0 overflow-hidden">
        <img :key="currentImage" :src="currentImage" :class="{ fade_animation_in: animation }"
            class="first_carousel carousel-image" />
        <img :key="currentImage2" :src="currentImage2" :class="{ fade_animation_in_2: animation2 }"
            class="second_carousel carousel-image " />
    </div>
</template>


<style lang="scss" scoped>
.carousel_container {
    width: 100%;
    overflow: hidden;
}


.carousel-image {
    opacity: 0;
    position: absolute;
    transform: scale(1.1);
    width: 100%;
    height: 100%;
    object-fit: cover;
    object-position: right;
    right: 0;
    // animation: fade_out 1s linear 6s;

}

.fade_animation_in {
    animation: fade_in 8s linear both;
}

.fade_animation_in_2 {
    animation: fade_in 10s linear both;
}



@keyframes fade_in {
    0% {
        opacity: 0;
        transform: scale(1.1);
    }

    20% {
        opacity: 1;
    }

    80% {
        opacity: 1;
    }

    100% {
        opacity: 0;
        transform: scale(1.3);
    }
}


@media screen and (min-width:576px) {


    .carousel_container {
        border-radius: 30px;
        width: 70vw;
        max-width: 80%;
        box-shadow: 0 0 40px rgba(0, 0, 0, 0.2), 0 0 40px rgba(0, 0, 0, 0.2);
    }

    .carousel-image {

        border-radius: 30px;
        width: 70vw;
    }
}
</style>