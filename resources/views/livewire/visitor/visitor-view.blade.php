<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <script src="https://hammerjs.github.io/dist/hammer.min.js"></script>
    <link rel="stylesheet" href="{{ asset('css/visitorview.css') }}">

</head>

<body>
    <div class="bg" id="bg">

    </div>

    <div class="carousel-cont">
        <div class="controls">
            <button id="prevBtn">
                < </button>
                    <button id="nextBtn"> > </button>
        </div>
        @if (is_array($artifact->collections))
            @foreach ($artifact->collections as $collection)
                <img class="image" src="{{ Storage::url($collection) }}" alt="Artifact image">
            @endforeach
        @endif

    </div>


    <div style="padding: 1em;" class="information">

        <h1 style="text-align: center;">
            {{ $artifact->name }}
        </h1>

        <div class="flex">
            <div class="input">
                <label>Artifacts Category</label>
                <input type="text" readonly value="{{ $artifact->category }}">
            </div>

            <div class="input">
                <label>Types of Artifacts</label>
                <input type="text" readonly value="{{ $artifact->type }}">
            </div>
        </div>

        <div class="flex">
            <div class="input">
                <label>Date Photograph</label>
                <input type="text" readonly value="{{ $artifact->date_photograph }}">
            </div>

            <div class="input">
                <label>Owned by</label>
                <input type="text" readonly value="{{ $artifact->owned_by }}">
            </div>

            <div class="input">
                <label>Donated by</label>
                <input type="text" readonly value="{{ $artifact->donated_by }}">
            </div>
        </div>

        <div class="input">
            <label>Description</label>
            <textarea name="" id="" readonly style="font-size: 1rem;">{{ $artifact->description }}</textarea>
        </div>

        <div class="input">
            <label>Story of Artifacts</label>
            <textarea name="" id="" readonly style="font-size: 1rem;">{{ $artifact->story }}</textarea>
        </div>
    </div>

    <script>
        const bg = document.getElementById('bg');
        const prevBtn = document.getElementById('prevBtn');
        const nextBtn = document.getElementById('nextBtn');
        const images = document.querySelectorAll('.carousel-cont img');
        let currentIndex = 0;
        let scale = 1;
        let pinchStartX = 0;
        let pinchStartY = 0;
        let dragStartX = 0;
        let dragStartY = 0;
        let isDragging = false;
        let currentTranslateX = 0;
        let currentTranslateY = 0;

        function updateCarousel() {
            images.forEach((img, index) => {
                img.style.display = index === currentIndex ? 'block' : 'none';
            });
        }

        prevBtn.addEventListener('click', () => {
            resetTransform()
            currentIndex = (currentIndex === 0) ? images.length - 1 : currentIndex - 1;
            updateCarousel();
        });

        nextBtn.addEventListener('click', () => {
            resetTransform()
            currentIndex = (currentIndex === images.length - 1) ? 0 : currentIndex + 1;
            updateCarousel();
        });

        updateCarousel();

        const carouselCont = document.querySelector('.carousel-cont');
        const hammer = new Hammer(carouselCont);

        hammer.get('pinch').set({
            enable: true
        });
        hammer.get('pan').set({
            enable: true
        });

        hammer.on('pinchstart', (e) => {
            pinchStartX = e.center.x;
            pinchStartY = e.center.y;
            scale = 1; // Reset the scale when pinch starts
        });

        hammer.on('pinchmove', (e) => {
            // Calculate the scale factor, but ensure it's not less than 1
            const newScale = Math.max(scale * e.scale, 1);
            images[currentIndex].style.transform = `scale(${newScale})`;

            // Adjust transform origin to zoom in on the pinch point
            images[currentIndex].style.transformOrigin =
                `${((e.center.x / carouselCont.offsetWidth) * 100)}% ${((e.center.y / carouselCont.offsetHeight) * 100)}%`;
        });

        hammer.on('pinchend', (e) => {
            scale = Math.max(scale * e.scale, 1); // Update scale but ensure it doesn't go below 1
        });

        hammer.on('panstart', (e) => {
            isDragging = true;
            dragStartX = e.center.x;
            dragStartY = e.center.y;
            images[currentIndex].style.cursor = 'grabbing';
        });

        hammer.on('panmove', (e) => {
            if (isDragging) {
                const deltaX = e.center.x - dragStartX;
                const deltaY = e.center.y - dragStartY;

                // Move the image by the delta distance, considering the scale factor
                currentTranslateX += deltaX / scale; // Adjust by scale to prevent excessive movement
                currentTranslateY += deltaY / scale; // Adjust by scale to prevent excessive movement

                // Update the transform property to move the image
                images[currentIndex].style.transform =
                    `scale(${scale}) translate(${currentTranslateX}px, ${currentTranslateY}px)`;

                dragStartX = e.center.x;
                dragStartY = e.center.y;
            }
        });

        hammer.on('panend', () => {
            isDragging = false;
            images[currentIndex].style.cursor = 'grab';
        });

        function resetTransform() {
            scale = 1;
            currentTranslateX = 0;
            currentTranslateY = 0;
            images.forEach(img => {
                img.style.transform = 'none';
                img.style.transformOrigin = 'center';
            });
        }

        images.forEach((img) => {
            img.addEventListener('dblclick', () => {
                if (img.classList.contains('fullscreen')) {
                    resetTransform()
                    img.classList.remove('fullscreen');
                    bg.style.display = 'none';
                    document.body.style.overflow = 'auto';
                } else {
                    resetTransform()
                    img.classList.add('fullscreen');
                    bg.style.display = 'block';
                    document.body.style.overflow = 'hidden';
                }
            });
        });
    </script>
</body>

</html>
