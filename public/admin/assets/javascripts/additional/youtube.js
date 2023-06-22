var csrf_token = $('meta[name="csrf-token"]').attr('content');

document.addEventListener('DOMContentLoaded', function() {
    var switchElements = document.getElementsByClassName('youtube-show-switch');

    for (var i = 0; i < switchElements.length; i++) {
        switchElements[i].addEventListener('change', function() {
            var isChecked = this.checked ? 1 : 0;
            var youtubeId = this.dataset.youtubeId;

            var url = "./youtube/edit_show";

            var form = document.createElement('form');
            form.setAttribute('method', 'POST');
            form.setAttribute('action', url);

            var showInput = document.createElement('input');
            showInput.setAttribute('type', 'hidden');
            showInput.setAttribute('name', '_method');
            showInput.setAttribute('value', 'PUT');

            var csrfInput = document.createElement('input');
            csrfInput.setAttribute('type', 'hidden');
            csrfInput.setAttribute('name', '_token');
            csrfInput.setAttribute('value', csrf_token);

            var showValueInput = document.createElement('input');
            showValueInput.setAttribute('type', 'hidden');
            showValueInput.setAttribute('name', 'show');
            showValueInput.setAttribute('value', isChecked);

            var youtubeIdInput = document.createElement('input');
            youtubeIdInput.setAttribute('type', 'hidden');
            youtubeIdInput.setAttribute('name', 'youtube_id');
            youtubeIdInput.setAttribute('value', youtubeId);

            form.appendChild(showInput);
            form.appendChild(csrfInput);
            form.appendChild(showValueInput);
            form.appendChild(youtubeIdInput);
            document.body.appendChild(form);

            form.addEventListener('submit', function() {
            });

            form.submit();
        });
    }
});
