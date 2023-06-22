window.addEventListener('DOMContentLoaded', () => {
  const image = document.getElementById('preview');
  const input = document.getElementById('inputImage');
  let cropper;
  const croppedImage = document.getElementById('croppedImage');
  const featuredInput = document.getElementById('featuredInput');

  input.addEventListener('change', (e) => {
    const files = e.target.files;
    const reader = new FileReader();
    reader.onload = () => {
      const img = new Image();
      img.src = reader.result;
      image.innerHTML = '';
      image.appendChild(img);
      cropper = new Cropper(img, {
        aspectRatio: 16 / 9,
        viewMode: 1,
        minCropBoxWidth: 100,
      });

      image.style.display = 'block';
      document.getElementById('cropButton').style.display = 'block';

      croppedImage.style.display = 'none';
    };
    reader.readAsDataURL(files[0]);
  });

  document.getElementById('cropButton').addEventListener('click', (e) => {
    e.preventDefault();
    const canvas = cropper.getCroppedCanvas();
    const croppedImageDataURL = canvas.toDataURL('image/jpeg');
    croppedImage.src = croppedImageDataURL;
    featuredInput.value = croppedImageDataURL;

    croppedImage.style.display = 'block';

    image.style.display = 'none';
    document.getElementById('cropButton').style.display = 'none';
  });
});