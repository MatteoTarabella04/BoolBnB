<script>
export default {
    name: 'DrawingPin',
    data() {


        return {


        }
    },
    methods: {
        randomPinColor() {
            const deg = Math.floor(Math.random() * 360 + 1)
            return 'hue-rotate(' + deg + 'deg)';
        },
    }
}
</script>
<template>
    <div class="w-100">
        <svg xmlns:svg="http://www.w3.org/2000/svg" xmlns="http://www.w3.org/2000/svg" class="position-absolute drawing_pin"
            :style="{ filter: randomPinColor() }" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.0" width="131.64143"
            height="123.81747" id="svg3253">
            <defs id="defs3255">
                <linearGradient id="linearGradient3672">
                    <stop id="stop3674" style="stop-color:#d43500;stop-opacity:1" offset="0" />
                    <stop id="stop3676" style="stop-color:#d42400;stop-opacity:1" offset="0.48051697" />
                    <stop id="stop3678" style="stop-color:#d40000;stop-opacity:1" offset="0.7361111" />
                    <stop id="stop3680" style="stop-color:#950000;stop-opacity:1" offset="1" />
                </linearGradient>
                <radialGradient cx="537.7536" cy="228.65007" r="0.74645507" fx="537.7536" fy="228.65007"
                    id="radialGradient2448" xlink:href="#linearGradient3228" gradientUnits="userSpaceOnUse"
                    gradientTransform="matrix(-0.7879742,0.5107254,-2.0451857,-3.1554214,1235.7385,709.11104)" />
                <linearGradient id="linearGradient3228">
                    <stop id="stop3230" style="stop-color:#ffffff;stop-opacity:1" offset="0" />
                    <stop id="stop3232" style="stop-color:#ffffff;stop-opacity:0" offset="1" />
                </linearGradient>
                <radialGradient cx="537.7536" cy="228.65007" r="0.74645507" fx="537.7536" fy="228.65007"
                    id="radialGradient2469" xlink:href="#linearGradient3228" gradientUnits="userSpaceOnUse"
                    gradientTransform="matrix(1.6288985,-1.2473361,4.9949231,6.5228797,-1652.775,-572.89743)" />
                <linearGradient id="linearGradient3216">
                    <stop id="stop3218" style="stop-color:#d43500;stop-opacity:1" offset="0" />
                    <stop id="stop3242" style="stop-color:#d42400;stop-opacity:1" offset="0.48051697" />
                    <stop id="stop3224" style="stop-color:#d40000;stop-opacity:1" offset="0.7361111" />
                    <stop id="stop3236" style="stop-color:#b20000;stop-opacity:1" offset="1" />
                </linearGradient>
                <radialGradient cx="302.83102" cy="4.6950564" r="8.9206038" fx="302.83102" fy="4.6950564"
                    id="radialGradient2464" xlink:href="#linearGradient3216" gradientUnits="userSpaceOnUse" />
                <linearGradient id="linearGradient3206">
                    <stop id="stop3214" style="stop-color:#7f0000;stop-opacity:0.5840708" offset="0" />
                    <stop id="stop3828" style="stop-color:#840000;stop-opacity:0.49803922" offset="0.66666669" />
                    <stop id="stop3210" style="stop-color:#000000;stop-opacity:0" offset="1" />
                </linearGradient>
                <radialGradient cx="302.83102" cy="4.6950564" r="8.9206038" fx="302.83102" fy="4.6950564"
                    id="radialGradient3543" xlink:href="#linearGradient3206" gradientUnits="userSpaceOnUse" />
                <radialGradient cx="278.53354" cy="12.798131" r="7.3867884" fx="278.53354" fy="12.798131"
                    id="radialGradient3541" xlink:href="#linearGradient3252" gradientUnits="userSpaceOnUse"
                    gradientTransform="matrix(1.6668441,0.2502283,-0.4353502,1.442447,-180.07171,-76.257909)" />
                <linearGradient id="linearGradient3384">
                    <stop id="stop3386" style="stop-color:#f60000;stop-opacity:1" offset="0" />
                    <stop id="stop3388" style="stop-color:#b30000;stop-opacity:1" offset="1" />
                </linearGradient>
                <radialGradient cx="305.97662" cy="4.6950564" r="8.9206038" fx="305.97662" fy="4.6950564"
                    id="radialGradient3539" xlink:href="#linearGradient3384" gradientUnits="userSpaceOnUse" />
                <filter x="-0.16439523" y="-0.21328184" width="1.3287905" height="1.4265637"
                    color-interpolation-filters="sRGB" id="filter3372">
                    <feGaussianBlur id="feGaussianBlur3374" stdDeviation="1.2413119" />
                </filter>
                <linearGradient id="linearGradient3252">
                    <stop id="stop3254" style="stop-color:#000000;stop-opacity:0.9910714" offset="0" />
                    <stop id="stop3926" style="stop-color:#000000;stop-opacity:0.6160714" offset="0.5138889" />
                    <stop id="stop3260" style="stop-color:#8d8d8d;stop-opacity:0" offset="1" />
                </linearGradient>
                <radialGradient cx="278.53354" cy="12.798131" r="7.3867884" fx="278.53354" fy="12.798131"
                    id="radialGradient3537" xlink:href="#linearGradient3252" gradientUnits="userSpaceOnUse"
                    gradientTransform="matrix(1.6668441,0.2502283,-0.4353502,1.442447,-180.07171,-76.257909)" />
                <radialGradient cx="278.53354" cy="12.798131" r="7.3867884" fx="278.53354" fy="12.798131"
                    id="radialGradient3985" xlink:href="#linearGradient3252" gradientUnits="userSpaceOnUse"
                    gradientTransform="matrix(1.6668441,0.2502283,-0.4353502,1.442447,-180.07171,-76.257909)" />
                <radialGradient cx="305.97662" cy="4.6950564" r="8.9206038" fx="305.97662" fy="4.6950564"
                    id="radialGradient3987" xlink:href="#linearGradient3384" gradientUnits="userSpaceOnUse" />
                <radialGradient cx="278.53354" cy="12.798131" r="7.3867884" fx="278.53354" fy="12.798131"
                    id="radialGradient3989" xlink:href="#linearGradient3252" gradientUnits="userSpaceOnUse"
                    gradientTransform="matrix(1.6668441,0.2502283,-0.4353502,1.442447,-180.07171,-76.257909)" />
                <radialGradient cx="302.83102" cy="4.6950564" r="8.9206038" fx="302.83102" fy="4.6950564"
                    id="radialGradient3991" xlink:href="#linearGradient3206" gradientUnits="userSpaceOnUse" />
                <radialGradient cx="537.7536" cy="228.65007" r="0.74645507" fx="537.7536" fy="228.65007"
                    id="radialGradient3993" xlink:href="#linearGradient3228" gradientUnits="userSpaceOnUse"
                    gradientTransform="matrix(-0.7879742,0.5107254,-2.0451857,-3.1554214,1235.7385,709.11104)" />
                <radialGradient cx="302.83102" cy="4.6950564" r="8.9206038" fx="302.83102" fy="4.6950564"
                    id="radialGradient3995" xlink:href="#linearGradient3216" gradientUnits="userSpaceOnUse" />
                <radialGradient cx="537.7536" cy="228.65007" r="0.74645507" fx="537.7536" fy="228.65007"
                    id="radialGradient3997" xlink:href="#linearGradient3228" gradientUnits="userSpaceOnUse"
                    gradientTransform="matrix(1.6288985,-1.2473361,4.9949231,6.5228797,-1652.775,-572.89743)" />
                <filter x="-0.10845805" y="-0.3767029" width="1.2169161" height="1.7534058"
                    color-interpolation-filters="sRGB" id="filter3722">
                    <feGaussianBlur id="feGaussianBlur3724" stdDeviation="1.3796041" />
                </filter>
                <radialGradient cx="302.65698" cy="3.2509735" r="8.9206038" fx="302.65698" fy="3.2509735"
                    id="radialGradient3780" xlink:href="#linearGradient3672" gradientUnits="userSpaceOnUse"
                    gradientTransform="matrix(0.75426487,0.68022863,-0.67730061,0.80830548,77.596144,-205.09431)" />
                <radialGradient cx="537.7536" cy="228.65007" r="0.74645507" fx="537.7536" fy="228.65007"
                    id="radialGradient3782" xlink:href="#linearGradient3228" gradientUnits="userSpaceOnUse"
                    gradientTransform="matrix(4.1462254,-2.980685,12.714161,18.199353,-4997.5042,-2364.106)" />
                <radialGradient cx="537.7536" cy="228.65007" r="0.74645507" fx="537.7536" fy="228.65007"
                    id="radialGradient4063" xlink:href="#linearGradient3228-0" gradientUnits="userSpaceOnUse"
                    gradientTransform="matrix(1.6288985,-1.2473361,4.9949231,6.5228797,-1652.775,-572.89743)" />
                <radialGradient cx="302.83102" cy="4.6950564" r="8.9206038" fx="302.83102" fy="4.6950564"
                    id="radialGradient4061" xlink:href="#linearGradient3216-8" gradientUnits="userSpaceOnUse" />
                <radialGradient cx="537.7536" cy="228.65007" r="0.74645507" fx="537.7536" fy="228.65007"
                    id="radialGradient4059-2" xlink:href="#linearGradient3228-0" gradientUnits="userSpaceOnUse"
                    gradientTransform="matrix(-0.7879742,0.5107254,-2.0451857,-3.1554214,1235.7385,709.11104)" />
                <radialGradient cx="302.83102" cy="4.6950564" r="8.9206038" fx="302.83102" fy="4.6950564"
                    id="radialGradient4057-1" xlink:href="#linearGradient3206-7" gradientUnits="userSpaceOnUse" />
                <radialGradient cx="278.53354" cy="12.798131" r="7.3867884" fx="278.53354" fy="12.798131"
                    id="radialGradient4055-3" xlink:href="#linearGradient3252-2" gradientUnits="userSpaceOnUse"
                    gradientTransform="matrix(1.6668441,0.2502283,-0.4353502,1.442447,-180.07171,-76.257909)" />
                <radialGradient cx="305.97662" cy="4.6950564" r="8.9206038" fx="305.97662" fy="4.6950564"
                    id="radialGradient4053-4" xlink:href="#linearGradient3384-6" gradientUnits="userSpaceOnUse" />
                <radialGradient cx="278.53354" cy="12.798131" r="7.3867884" fx="278.53354" fy="12.798131"
                    id="radialGradient4051-5" xlink:href="#linearGradient3252-2" gradientUnits="userSpaceOnUse"
                    gradientTransform="matrix(1.6668441,0.2502283,-0.4353502,1.442447,-180.07171,-76.257909)" />
                <filter color-interpolation-filters="sRGB" id="filter4036">
                    <feGaussianBlur stdDeviation="0.52661716" id="feGaussianBlur4038" />
                </filter>
                <radialGradient cx="537.7536" cy="228.65007" r="0.74645507" fx="537.7536" fy="228.65007"
                    id="radialGradient3997-9" xlink:href="#linearGradient3228-0" gradientUnits="userSpaceOnUse"
                    gradientTransform="matrix(1.6288985,-1.2473361,4.9949231,6.5228797,-1652.775,-572.89743)" />
                <radialGradient cx="302.83102" cy="4.6950564" r="8.9206038" fx="302.83102" fy="4.6950564"
                    id="radialGradient3995-7" xlink:href="#linearGradient3216-8" gradientUnits="userSpaceOnUse" />
                <radialGradient cx="537.7536" cy="228.65007" r="0.74645507" fx="537.7536" fy="228.65007"
                    id="radialGradient3993-2" xlink:href="#linearGradient3228-0" gradientUnits="userSpaceOnUse"
                    gradientTransform="matrix(-0.7879742,0.5107254,-2.0451857,-3.1554214,1235.7385,709.11104)" />
                <radialGradient cx="302.83102" cy="4.6950564" r="8.9206038" fx="302.83102" fy="4.6950564"
                    id="radialGradient3991-9" xlink:href="#linearGradient3206-7" gradientUnits="userSpaceOnUse" />
                <radialGradient cx="278.53354" cy="12.798131" r="7.3867884" fx="278.53354" fy="12.798131"
                    id="radialGradient3989-8" xlink:href="#linearGradient3252-2" gradientUnits="userSpaceOnUse"
                    gradientTransform="matrix(1.6668441,0.2502283,-0.4353502,1.442447,-180.07171,-76.257909)" />
                <radialGradient cx="305.97662" cy="4.6950564" r="8.9206038" fx="305.97662" fy="4.6950564"
                    id="radialGradient3987-1" xlink:href="#linearGradient3384-6" gradientUnits="userSpaceOnUse" />
                <radialGradient cx="278.53354" cy="12.798131" r="7.3867884" fx="278.53354" fy="12.798131"
                    id="radialGradient3985-6" xlink:href="#linearGradient3252-2" gradientUnits="userSpaceOnUse"
                    gradientTransform="matrix(1.6668441,0.2502283,-0.4353502,1.442447,-180.07171,-76.257909)" />
                <radialGradient cx="278.53354" cy="12.798131" r="7.3867884" fx="278.53354" fy="12.798131"
                    id="radialGradient3537-5" xlink:href="#linearGradient3252-2" gradientUnits="userSpaceOnUse"
                    gradientTransform="matrix(1.6668441,0.2502283,-0.4353502,1.442447,-180.07171,-76.257909)" />
                <linearGradient id="linearGradient3252-2">
                    <stop id="stop3254-1" style="stop-color:#000000;stop-opacity:0.9910714" offset="0" />
                    <stop id="stop3926-6" style="stop-color:#000000;stop-opacity:0.6160714" offset="0.5138889" />
                    <stop id="stop3260-8" style="stop-color:#8d8d8d;stop-opacity:0" offset="1" />
                </linearGradient>
                <filter x="-0.16439523" y="-0.21328184" width="1.3287905" height="1.4265637"
                    color-interpolation-filters="sRGB" id="filter3372-3">
                    <feGaussianBlur stdDeviation="1.2413119" id="feGaussianBlur3374-2" />
                </filter>
                <radialGradient cx="305.97662" cy="4.6950564" r="8.9206038" fx="305.97662" fy="4.6950564"
                    id="radialGradient3539-2" xlink:href="#linearGradient3384-6" gradientUnits="userSpaceOnUse" />
                <linearGradient id="linearGradient3384-6">
                    <stop id="stop3386-1" style="stop-color:#f60000;stop-opacity:1" offset="0" />
                    <stop id="stop3388-4" style="stop-color:#b30000;stop-opacity:1" offset="1" />
                </linearGradient>
                <radialGradient cx="278.53354" cy="12.798131" r="7.3867884" fx="278.53354" fy="12.798131"
                    id="radialGradient3541-7" xlink:href="#linearGradient3252-2" gradientUnits="userSpaceOnUse"
                    gradientTransform="matrix(1.6668441,0.2502283,-0.4353502,1.442447,-180.07171,-76.257909)" />
                <radialGradient cx="302.83102" cy="4.6950564" r="8.9206038" fx="302.83102" fy="4.6950564"
                    id="radialGradient3543-2" xlink:href="#linearGradient3206-7" gradientUnits="userSpaceOnUse" />
                <linearGradient id="linearGradient3206-7">
                    <stop id="stop3214-1" style="stop-color:#7f0000;stop-opacity:1" offset="0" />
                    <stop id="stop3828-1" style="stop-color:#840000;stop-opacity:0.49803922" offset="0.66666669" />
                    <stop id="stop3210-5" style="stop-color:#000000;stop-opacity:0" offset="1" />
                </linearGradient>
                <radialGradient cx="302.83102" cy="4.6950564" r="8.9206038" fx="302.83102" fy="4.6950564"
                    id="radialGradient2464-1" xlink:href="#linearGradient3216-8" gradientUnits="userSpaceOnUse" />
                <linearGradient id="linearGradient3216-8">
                    <stop id="stop3218-2" style="stop-color:#d43500;stop-opacity:1" offset="0" />
                    <stop id="stop3242-4" style="stop-color:#d42400;stop-opacity:1" offset="0.48051697" />
                    <stop id="stop3224-5" style="stop-color:#d40000;stop-opacity:1" offset="0.7361111" />
                    <stop id="stop3236-5" style="stop-color:#b20000;stop-opacity:1" offset="1" />
                </linearGradient>
                <radialGradient cx="537.7536" cy="228.65007" r="0.74645507" fx="537.7536" fy="228.65007"
                    id="radialGradient2469-8" xlink:href="#linearGradient3228-0" gradientUnits="userSpaceOnUse"
                    gradientTransform="matrix(1.6288985,-1.2473361,4.9949231,6.5228797,-1652.775,-572.89743)" />
                <linearGradient id="linearGradient3228-0">
                    <stop id="stop3230-9" style="stop-color:#ffffff;stop-opacity:1" offset="0" />
                    <stop id="stop3232-4" style="stop-color:#ffffff;stop-opacity:0" offset="1" />
                </linearGradient>
                <radialGradient cx="537.7536" cy="228.65007" r="0.74645507" fx="537.7536" fy="228.65007"
                    id="radialGradient2448-4" xlink:href="#linearGradient3228-0" gradientUnits="userSpaceOnUse"
                    gradientTransform="matrix(-0.7879742,0.5107254,-2.0451857,-3.1554214,1235.7385,709.11104)" />
                <radialGradient cx="305.97662" cy="4.6950564" r="8.9206038" fx="305.97662" fy="4.6950564"
                    id="radialGradient3902" xlink:href="#linearGradient3384" gradientUnits="userSpaceOnUse" />
                <radialGradient cx="278.53354" cy="12.798131" r="7.3867884" fx="278.53354" fy="12.798131"
                    id="radialGradient3904" xlink:href="#linearGradient3252" gradientUnits="userSpaceOnUse"
                    gradientTransform="matrix(1.6668441,0.2502283,-0.4353502,1.442447,-180.07171,-76.257909)" />
                <radialGradient cx="302.83102" cy="4.6950564" r="8.9206038" fx="302.83102" fy="4.6950564"
                    id="radialGradient3906" xlink:href="#linearGradient3206" gradientUnits="userSpaceOnUse" />
                <radialGradient cx="537.7536" cy="228.65007" r="0.74645507" fx="537.7536" fy="228.65007"
                    id="radialGradient3908" xlink:href="#linearGradient3228" gradientUnits="userSpaceOnUse"
                    gradientTransform="matrix(-0.7879742,0.5107254,-2.0451857,-3.1554214,1235.7385,709.11104)" />
                <radialGradient cx="278.53354" cy="12.798131" r="7.3867884" fx="278.53354" fy="12.798131"
                    id="radialGradient3910" xlink:href="#linearGradient3252" gradientUnits="userSpaceOnUse"
                    gradientTransform="matrix(1.6668441,0.2502283,-0.4353502,1.442447,-180.07171,-76.257909)" />
                <radialGradient cx="305.97662" cy="4.6950564" r="8.9206038" fx="305.97662" fy="4.6950564"
                    id="radialGradient3917" xlink:href="#linearGradient3384" gradientUnits="userSpaceOnUse" />
                <radialGradient cx="278.53354" cy="12.798131" r="7.3867884" fx="278.53354" fy="12.798131"
                    id="radialGradient3919" xlink:href="#linearGradient3252" gradientUnits="userSpaceOnUse"
                    gradientTransform="matrix(1.6668441,0.2502283,-0.4353502,1.442447,-180.07171,-76.257909)" />
                <radialGradient cx="302.83102" cy="4.6950564" r="8.9206038" fx="302.83102" fy="4.6950564"
                    id="radialGradient3921" xlink:href="#linearGradient3206" gradientUnits="userSpaceOnUse" />
                <radialGradient cx="537.7536" cy="228.65007" r="0.74645507" fx="537.7536" fy="228.65007"
                    id="radialGradient3923" xlink:href="#linearGradient3228" gradientUnits="userSpaceOnUse"
                    gradientTransform="matrix(-0.7879742,0.5107254,-2.0451857,-3.1554214,1235.7385,709.11104)" />
                <radialGradient cx="537.7536" cy="228.65007" r="0.74645507" fx="537.7536" fy="228.65007"
                    id="radialGradient3926" xlink:href="#linearGradient3228" gradientUnits="userSpaceOnUse"
                    gradientTransform="matrix(-4.0973158,2.6711224,-10.634576,-16.50303,5075.3642,2587.3857)" />
                <radialGradient cx="278.53354" cy="12.798131" r="7.3867884" fx="278.53354" fy="12.798131"
                    id="radialGradient3933" xlink:href="#linearGradient3252" gradientUnits="userSpaceOnUse"
                    gradientTransform="matrix(1.6668441,0.2502283,-0.4353502,1.442447,-180.07171,-76.257909)" />
                <radialGradient cx="302.65698" cy="3.2509735" r="8.9206038" fx="302.65698" fy="3.2509735"
                    id="radialGradient3944" xlink:href="#linearGradient3672" gradientUnits="userSpaceOnUse"
                    gradientTransform="matrix(0.75426487,0.68022863,-0.67730061,0.80830548,77.596144,-205.09431)" />
                <radialGradient cx="537.7536" cy="228.65007" r="0.74645507" fx="537.7536" fy="228.65007"
                    id="radialGradient3946" xlink:href="#linearGradient3228" gradientUnits="userSpaceOnUse"
                    gradientTransform="matrix(4.1462254,-2.980685,12.714161,18.199353,-4997.5042,-2364.106)" />
                <radialGradient cx="537.7536" cy="228.65007" r="0.74645507" fx="537.7536" fy="228.65007"
                    id="radialGradient3949" xlink:href="#linearGradient3228" gradientUnits="userSpaceOnUse"
                    gradientTransform="matrix(5.828109,-3.59902,17.87156,21.974759,-6722.8696,-2885.2528)" />
                <radialGradient cx="305.97662" cy="4.6950564" r="8.9206038" fx="305.97662" fy="4.6950564"
                    id="radialGradient3952" xlink:href="#linearGradient3384" gradientUnits="userSpaceOnUse" />
                <radialGradient cx="302.83102" cy="4.6950564" r="8.9206038" fx="302.83102" fy="4.6950564"
                    id="radialGradient3954" xlink:href="#linearGradient3206" gradientUnits="userSpaceOnUse" />
                <radialGradient cx="302.65698" cy="3.2509735" r="8.9206038" fx="302.65698" fy="3.2509735"
                    id="radialGradient3956" xlink:href="#linearGradient3672" gradientUnits="userSpaceOnUse"
                    gradientTransform="matrix(0.75426487,0.68022863,-0.67730061,0.80830548,77.596144,-205.09431)" />
                <radialGradient cx="537.7536" cy="228.65007" r="0.74645507" fx="537.7536" fy="228.65007"
                    id="radialGradient3971" xlink:href="#linearGradient3228" gradientUnits="userSpaceOnUse"
                    gradientTransform="matrix(5.828109,-3.59902,17.87156,21.974759,-6695.5773,-2611.1704)" />
                <radialGradient cx="537.7536" cy="228.65007" r="0.74645507" fx="537.7536" fy="228.65007"
                    id="radialGradient3975" xlink:href="#linearGradient3228" gradientUnits="userSpaceOnUse"
                    gradientTransform="matrix(-4.0973158,2.6711224,-10.634576,-16.50303,5102.6565,2861.4681)" />
                <radialGradient cx="278.53354" cy="12.798131" r="7.3867884" fx="278.53354" fy="12.798131"
                    id="radialGradient3981" xlink:href="#linearGradient3252-2" gradientUnits="userSpaceOnUse"
                    gradientTransform="matrix(1.6668441,0.2502283,-0.4353502,1.442447,-180.07171,-76.257909)" />
                <radialGradient cx="305.97662" cy="4.6950564" r="8.9206038" fx="305.97662" fy="4.6950564"
                    id="radialGradient3983" xlink:href="#linearGradient3384-6" gradientUnits="userSpaceOnUse" />
                <radialGradient cx="278.53354" cy="12.798131" r="7.3867884" fx="278.53354" fy="12.798131"
                    id="radialGradient3986" xlink:href="#linearGradient3252-2" gradientUnits="userSpaceOnUse"
                    gradientTransform="matrix(1.6668441,0.2502283,-0.4353502,1.442447,-180.07171,-76.257909)" />
                <radialGradient cx="302.83102" cy="4.6950564" r="8.9206038" fx="302.83102" fy="4.6950564"
                    id="radialGradient3988" xlink:href="#linearGradient3206-7" gradientUnits="userSpaceOnUse" />
                <radialGradient cx="537.7536" cy="228.65007" r="0.74645507" fx="537.7536" fy="228.65007"
                    id="radialGradient3990" xlink:href="#linearGradient3228-0" gradientUnits="userSpaceOnUse"
                    gradientTransform="matrix(-0.7879742,0.5107254,-2.0451857,-3.1554214,1235.7385,709.11104)" />
                <radialGradient cx="302.83102" cy="4.6950564" r="8.9206038" fx="302.83102" fy="4.6950564"
                    id="radialGradient3992" xlink:href="#linearGradient3216-8" gradientUnits="userSpaceOnUse" />
                <radialGradient cx="537.7536" cy="228.65007" r="0.74645507" fx="537.7536" fy="228.65007"
                    id="radialGradient3994" xlink:href="#linearGradient3228-0" gradientUnits="userSpaceOnUse"
                    gradientTransform="matrix(1.6288985,-1.2473361,4.9949231,6.5228797,-1652.775,-572.89743)" />
                <filter color-interpolation-filters="sRGB" id="filter4015">
                    <feGaussianBlur id="feGaussianBlur4017" stdDeviation="0.33662797" />
                </filter>
                <radialGradient cx="278.53354" cy="12.798131" r="7.3867884" fx="278.53354" fy="12.798131"
                    id="radialGradient4028" xlink:href="#linearGradient3252" gradientUnits="userSpaceOnUse"
                    gradientTransform="matrix(1.6668441,0.2502283,-0.4353502,1.442447,-180.07171,-76.257909)" />
                <radialGradient cx="305.97662" cy="4.6950564" r="8.9206038" fx="305.97662" fy="4.6950564"
                    id="radialGradient4030" xlink:href="#linearGradient3384" gradientUnits="userSpaceOnUse" />
                <radialGradient cx="278.53354" cy="12.798131" r="7.3867884" fx="278.53354" fy="12.798131"
                    id="radialGradient4032" xlink:href="#linearGradient3252" gradientUnits="userSpaceOnUse"
                    gradientTransform="matrix(1.6668441,0.2502283,-0.4353502,1.442447,-180.07171,-76.257909)" />
                <radialGradient cx="302.83102" cy="4.6950564" r="8.9206038" fx="302.83102" fy="4.6950564"
                    id="radialGradient4034" xlink:href="#linearGradient3206" gradientUnits="userSpaceOnUse" />
                <radialGradient cx="537.7536" cy="228.65007" r="0.74645507" fx="537.7536" fy="228.65007"
                    id="radialGradient4036" xlink:href="#linearGradient3228" gradientUnits="userSpaceOnUse"
                    gradientTransform="matrix(-4.0973158,2.6711224,-10.634576,-16.50303,5102.6565,2861.4681)" />
                <radialGradient cx="302.65698" cy="3.2509735" r="8.9206038" fx="302.65698" fy="3.2509735"
                    id="radialGradient4038" xlink:href="#linearGradient3672" gradientUnits="userSpaceOnUse"
                    gradientTransform="matrix(0.75426487,0.68022863,-0.67730061,0.80830548,77.596144,-205.09431)" />
                <radialGradient cx="537.7536" cy="228.65007" r="0.74645507" fx="537.7536" fy="228.65007"
                    id="radialGradient4040" xlink:href="#linearGradient3228" gradientUnits="userSpaceOnUse"
                    gradientTransform="matrix(5.828109,-3.59902,17.87156,21.974759,-6695.5773,-2611.1704)" />
            </defs>
            <g transform="translate(-399.12896,-466.20693)" id="layer1">
                <g id="g4019">
                    <path
                        d="m 286.17579,14.556754 a 7.3867884,8.4657574 0 1 1 -14.77358,0 7.3867884,8.4657574 0 1 1 14.77358,0 z"
                        transform="matrix(1.2623445,3.1594993,-5.7629836,2.485463,192.03711,-379.19361)" id="path3250"
                        style="opacity:0.62019228;fill:url(#radialGradient4028);fill-opacity:1;stroke:none;filter:url(#filter3722)" />
                    <path
                        d="m 311.75163,4.6950564 a 8.9206038,8.9206038 0 1 1 -17.84121,0 8.9206038,8.9206038 0 1 1 17.84121,0 z"
                        transform="matrix(3.4214258,0,0,3.4413275,-545.22993,495.41808)" id="path3202"
                        style="fill:url(#radialGradient4030);fill-opacity:1;stroke:none" />
                    <path
                        d="m 286.17579,14.556754 a 7.3867884,8.4657574 0 1 1 -14.77358,0 7.3867884,8.4657574 0 1 1 14.77358,0 z"
                        transform="matrix(1.3570719,2.2761848,-2.5510628,1.2409826,136.43597,-137.7803)" id="path3474"
                        style="opacity:0.30288463;fill:url(#radialGradient4032);fill-opacity:1;stroke:none;filter:url(#filter3372)" />
                    <path
                        d="m 311.75163,4.6950564 a 8.9206038,8.9206038 0 1 1 -17.84121,0 8.9206038,8.9206038 0 1 1 17.84121,0 z"
                        transform="matrix(2.1108123,0,0,2.1230905,-144.38559,495.36189)" id="path3468"
                        style="fill:url(#radialGradient4034);fill-opacity:1;stroke:none;filter:url(#filter4015)" />
                    <path
                        d="m 474.20247,531.25665 c -6.49758,-5.22023 -8.24664,-8.17767 -7.25764,-14.18083 2.81762,7.7769 6.97165,13.73689 7.25764,14.18083 z"
                        id="path3478"
                        style="opacity:0.74038463;fill:url(#radialGradient4036);fill-opacity:1;fill-rule:evenodd;stroke:none" />
                    <path
                        d="m 311.75163,4.6950564 a 8.9206038,8.9206038 0 1 1 -17.84121,0 8.9206038,8.9206038 0 1 1 17.84121,0 z"
                        transform="matrix(2.3962489,0.18196662,0,2.4872322,-216.26409,421.672)" id="path3204"
                        style="fill:url(#radialGradient4038);fill-opacity:1;stroke:none" />
                    <path
                        d="m 514.32082,468.93198 c 10.34986,6.92827 13.31762,10.86742 12.53837,18.89628 -5.13376,-10.37127 -12.05767,-18.30518 -12.53837,-18.89628 z"
                        id="path3226" style="fill:url(#radialGradient4040);fill-opacity:1;fill-rule:evenodd;stroke:none" />
                </g>
            </g>
        </svg>
    </div>
</template>


<style lang="scss" scoped></style>