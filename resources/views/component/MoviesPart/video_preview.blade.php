<div class="modal fade" id="video_preview" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Video Preview</h5>

 {{--               <video
                    id="my-video"
                    class="video-js"
                    controls
                    preload="auto"
                    width="640"
                    height="264"
                    poster="MY_VIDEO_POSTER.jpg"
                    data-setup="{}"
                >
                    <source src="file:///C:/Users/Dell/Downloads/Untitled%20video%20-%20Made%20with%20Clipchamp.mp4" id="video_preview_input" type="video/mp4" />
--}}{{--                    <source src="MY_VIDEO.webm" type="video/webm" />--}}{{--
                    <p class="vjs-no-js">
                        To view this video please enable JavaScript, and consider upgrading to a
                        web browser that
                        <a href="https://videojs.com/html5-video-support/" target="_blank"
                        >supports HTML5 video</a
                        >
                    </p>
                </video>--}}

                <video width="320" height="240" controls>
                    <source id="video_preview_input" src="file:///C:/Users/Dell/Downloads/Untitled%20video%20-%20Made%20with%20Clipchamp.mp4" type="video/mp4">
                    <source id="video_preview_input" src="file:///C:/Users/Dell/Downloads/Untitled%20video%20-%20Made%20with%20Clipchamp.mp4" type="video/ogg">
                    Your browser does not support the video tag.
                </video>
                <button data-bs-toggle="modal" data-bs-target="#createmodal" type="button" class="modal-close" ></button>
            </div>
            <div class="card m-0">
                <video class="img-fluid" id="video_preview" src=""></video>
            </div>
        </div>
    </div>
</div>
