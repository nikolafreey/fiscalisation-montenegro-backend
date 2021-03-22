@extends('admin.layout')

@section('content')

    <div class="content-i">
        <div class="content-box"><div class="row">
                <div class="col-lg-10">
                    <div class="element-wrapper">
                        <div class="element-box">

                            <form
                                method="POST"
                                action="{{ $action ? route('blogs.update', $blog) : route('blogs.store') }}" enctype="multipart/form-data"
                            >
                                @method($method)
                                @csrf
                                <h5 class="form-header">
                                    Dodajte Blog
                                </h5>
                                <div class="form-group">
                                    <label for="naziv">Unesite naziv bloga</label>
                                    <input type="text" class="form-control" id="naziv" aria-describedby="emailHelp" placeholder="Unesite naziv" name="naziv" value="{{ old('naziv', $blog->naziv) }}">
                                    @error('naziv')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group row">
                                    <div class="col-sm-12 col-md-6 col-lg-4">

                                        <div class="custom-file">
                                            <input
                                                class="custom-file-input"
                                                data-name="slika"
                                                id="slika"
                                                type="file"
                                            >
                                            <label class="custom-file-label" for="slika">
                                                <p>Odaberite sliku</p>
                                            </label>
                                        </div>
                                        <input
                                            type="hidden"
                                            id="slika_cropped"
                                        >

                                    </div>
                                    <div class="col-lg-8 js-cropper-tools" data-name="slika" style="display: none;">
                                        <div class="row">
                                            <div class="col-12" style="height: 400px;">
                                                <img id="cropper-image-slika" style="height: 100%;">
                                            </div>
                                        </div>

                                        <div class="row mt-3">
                                            <div class="col-12 text-center">
                                                <button
                                                    id="btn-crop-slika"
                                                    class="btn btn-secondary"
                                                    data-name="slika"
                                                    type="button"
                                                >
                                                    <i class="fa fa-cut"></i>
                                                    &nbsp;&nbsp;&nbsp;
                                                    {{ __('Crop') }}
                                                </button>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-sm-12 col-md-6 col-lg-4">
                                        <img
                                            src="{{ old('slika', Storage::url($blog->slika)) }}"
                                            class="preview_slika_cropped mb-3 img-thumbnail img-fluid"
                                            @if(! old('slika', Storage::url($blog->slika)))
                                            style="display: none;"
                                            @endif
                                        >
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="tekst">Unesite tekst</label>
                                    <textarea class="form-control" id="tekst" rows="3" name="tekst" placeholder="Unesite tekst">{{ old('tekst', $blog->tekst) }}</textarea>
                                    @error('tekst')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label for="blog_category_id">Example select</label>
                                    <select class="form-control" id="blog_category_id" name="blog_category_id">
                                        @foreach($blogCategories as $category)
                                            <option
                                                @if(old('blog_category_id') === $category->id)
                                                selected
                                                @endif
                                                value="{{ $category->id }}"
                                            >
                                                {{ $category->naziv }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('blog_category_id')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-buttons-w">
                                    <button class="btn btn-primary" type="submit">
                                        Dodajte
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


@endsection

@section('scripts')

    <script>
        tinymce.init({
            selector: '#tekst',
            plugins: 'autoresize advlist hr charmap fullscreen insertdatetime image link preview searchreplace visualblocks wordcount help lists code',
            toolbar: 'fullscreen | undo redo | bold italic forecolor backcolor styleselect | numlist bullist | alignleft aligncenter alignright alignjustify | link insertfile image | a11ycheck preview code visualblocks wordcount | searchreplace | help',
            advlist_bullet_styles: "square",
            automatic_uploads: true,
            branding: false,
            max_height: 600,
            min_height: 400,
            paste_data_images : true,
            file_picker_types: 'image',
            file_picker_callback: function (cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');

                /*
                  Note: In modern browsers input[type="file"] is functional without
                  even adding it to the DOM, but that might not be the case in some older
                  or quirky browsers like IE, so you might want to add it to the DOM
                  just in case, and visually hide it. And do not forget do remove it
                  once you do not need it anymore.
                */

                input.onchange = function () {
                    var file = this.files[0];

                    var reader = new FileReader();
                    reader.onload = function () {
                        /*
                          Note: Now we need to register the blob in TinyMCEs image blob
                          registry. In the next release this part hopefully won't be
                          necessary, as we are looking to handle it internally.
                        */
                        var id = 'blobid' + (new Date()).getTime();
                        var blobCache =  tinymce.activeEditor.editorUpload.blobCache;
                        var base64 = reader.result.split(',')[1];
                        var blobInfo = blobCache.create(id, file, base64);
                        blobCache.add(blobInfo);

                        /* call the callback and populate the Title field with the file name */
                        cb(blobInfo.blobUri(), { title: file.name });
                    };
                    reader.readAsDataURL(file);
                };
                input.click();
            },
        });

        $(document).ready(function () {
            $('#slika').change(function () {
                let name = $(this).data('name');
                $('.preview_slika_cropped').hide();
                $('.js-cropper-tools[data-name="' + name + '"]').show();
                readURL(this, name);
            });
        });

        function readURL(input, name) {
            if (input.files && input.files[0]) {
                let reader = new FileReader();
                reader.onload = function (e) {
                    $('#cropper-image-slika').attr('src', e.target.result);
                    initCropper(input, name, 1);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }

        function initCropper(input, name, viewMode) {
            var $element = $('#cropper-image-slika');
            $element.cropper('destroy');
            $element.cropper({
                viewMode: viewMode
            });
        }

        $('#btn-crop-slika').on('click', function (e) {
            e.preventDefault();
            let name = $(this).data('name');
            $('#cropper-image-slika').cropper('getCroppedCanvas', {
                fillColor: '#fff',
            }).toBlob(function (blob) {
                let formData = new FormData();
                formData.append('image', blob);
                $.ajax({
                    method: 'POST',
                    url: '{{ route("cropper.images") }}',
                    data: formData,
                    processData: false,
                    contentType: false,
                    success: function (data) {
                        if (!data) {
                            toastr.error('{{ __('Failure. The size of the cropped image is: ') }}' + formatBytes(blob.size, 2));
                            return;
                        }
                        let image = data;
                        $('#' + name + '_cropped')
                            .attr('name', name)
                            .val(image);
                        $('.preview_' + name + '_cropped').attr('src', image).show();
                        $('#cropper-image-slika').cropper('destroy');
                        $('#cropper-image-slika').removeAttr('src').hide();
                        $('.js-cropper-tools[data-name="' + name + '"]').hide();
                        toastr.success('{{ __("Image has been cropped") }}');
                    },
                    error: function (data) {
                        toastr.error('{{ __('Cropper failed') }}');
                    }
                });
            }, 'image/jpeg');
        });
        $('.cropper-vm').on('click', function (e) {
            e.preventDefault();
            $(this).parent().children('.font-weight-bold').removeClass('font-weight-bold');
            $(this).addClass('font-weight-bold');
            let name = $(this).parent().parent().data('name');
            let viewMode = parseInt($(this).data('value'));

            initCropper(null, name, viewMode);
        });
        $('.cropper-ar').on('click', function (e) {
            e.preventDefault();
            $(this).parent().children('.font-weight-bold').removeClass('font-weight-bold');
            $(this).addClass('font-weight-bold');
            let name = $(this).parent().parent().data('name');
            let viewMode = $(this).parent().parent().find('.view-modes').find('.font-weight-bold').data('value');

            initCropper(null, name, viewMode);
        });
        $('.cropper-input-details').on("change", function (e) {
            e.preventDefault();
            if (!$.isNumeric($(this).val())) {
                return;
            }
            let name = $(this).parents(':eq(2)').data('name');
            let x = parseFloat($(this).parent().parent().find('input.cropper-' + name + '-x').val());
            let y = parseFloat($(this).parent().parent().find('input.cropper-' + name + '-y').val());
            let width = parseFloat($(this).parent().parent().find('input.cropper-' + name + '-width').val());
            let height = parseFloat($(this).parent().parent().find('input.cropper-' + name + '-height').val());
            $('#cropper-image-slika').cropper('setData', {
                x: x,
                y: y,
                height: height,
                width: width,
            });
        });

        function formatBytes(a, b) {
            if (0 === a) return "0 Bytes";
            let c = 1024,
                d = b || 2,
                e = ["Bytes", "KB", "MB", "GB", "TB", "PB", "EB", "ZB", "YB"],
                f = Math.floor(Math.log(a) / Math.log(c));
            return parseFloat((a / Math.pow(c, f)).toFixed(d)) + " " + e[f];
        }
    </script>

@endsection
