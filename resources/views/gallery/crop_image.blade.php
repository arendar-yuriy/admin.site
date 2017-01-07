@extends('layout.default.main')

@section('central')

    <div class="container">
        <div class="row">
            <div class="col-md-9">
                <!-- <h3 class="page-header">Demo:</h3> -->
                <div class="img-container">
                    <img src="{{ Config::get('admin.image_url').$content->image }}" alt="Picture">
                </div>
            </div>
            <div class="col-md-3">
                <!-- <h3 class="page-header">Preview:</h3> -->
                <div class="docs-preview clearfix">
                    <div class="img-preview preview-lg"></div>
                    <div class="img-preview preview-md"></div>
                    <div class="img-preview preview-sm"></div>
                    <div class="img-preview preview-xs"></div>
                </div>

                <!-- <h3 class="page-header">Data:</h3> -->
                <div class="docs-data">
                    <div class="input-group input-group-sm">
                        <label class="input-group-addon" for="dataX">X</label>
                        <input type="text" class="form-control" id="dataX" placeholder="x">
                        <span class="input-group-addon">px</span>
                    </div>
                    <div class="input-group input-group-sm">
                        <label class="input-group-addon" for="dataY">Y</label>
                        <input type="text" class="form-control" id="dataY" placeholder="y">
                        <span class="input-group-addon">px</span>
                    </div>
                    <div class="input-group input-group-sm">
                        <label class="input-group-addon" for="dataWidth">Width</label>
                        <input type="text" class="form-control" id="dataWidth" placeholder="width">
                        <span class="input-group-addon">px</span>
                    </div>
                    <div class="input-group input-group-sm">
                        <label class="input-group-addon" for="dataHeight">Height</label>
                        <input type="text" class="form-control" id="dataHeight" placeholder="height">
                        <span class="input-group-addon">px</span>
                    </div>
                    <div class="input-group input-group-sm">
                        <label class="input-group-addon" for="dataRotate">Rotate</label>
                        <input type="text" class="form-control" id="dataRotate" placeholder="rotate">
                        <span class="input-group-addon">deg</span>
                    </div>
                    <div class="input-group input-group-sm">
                        <label class="input-group-addon" for="dataScaleX">ScaleX</label>
                        <input type="text" class="form-control" id="dataScaleX" placeholder="scaleX">
                    </div>
                    <div class="input-group input-group-sm">
                        <label class="input-group-addon" for="dataScaleY">ScaleY</label>
                        <input type="text" class="form-control" id="dataScaleY" placeholder="scaleY">
                    </div>
                </div>
            </div>
        </div>
        <div class="row" id="actions">
            <div class="col-md-9 docs-buttons">
                <!-- <h3 class="page-header">Toolbar:</h3> -->
                <div class="btn-group">
                    <button type="button" class="btn btn-primary" data-method="setDragMode" data-option="move" title="Move">
            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.setDragMode(&quot;move&quot;)">
              <i class="icon-move"></i>
            </span>
                    </button>
                    <button type="button" class="btn btn-primary" data-method="setDragMode" data-option="crop" title="Crop">
            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.setDragMode(&quot;crop&quot;)">
              <i class="icon-crop"></i>
            </span>
                    </button>
                </div>

                <div class="btn-group">
                    <button type="button" class="btn btn-primary" data-method="zoom" data-option="0.1" title="Zoom In">
            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.zoom(0.1)">
              <i class=" icon-zoomin3"></i>
            </span>
                    </button>
                    <button type="button" class="btn btn-primary" data-method="zoom" data-option="-0.1" title="Zoom Out">
            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.zoom(-0.1)">
              <i class=" icon-zoomout3"></i>
            </span>
                    </button>
                </div>

                <div class="btn-group">
                    <button type="button" class="btn btn-primary" data-method="move" data-option="-10" data-second-option="0" title="Move Left">
            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.move(-10, 0)">
              <i class=" icon-arrow-left7"></i>
            </span>
                    </button>
                    <button type="button" class="btn btn-primary" data-method="move" data-option="10" data-second-option="0" title="Move Right">
            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.move(10, 0)">
              <i class=" icon-arrow-right7"></i>
            </span>
                    </button>
                    <button type="button" class="btn btn-primary" data-method="move" data-option="0" data-second-option="-10" title="Move Up">
            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.move(0, -10)">
              <span class=" icon-arrow-up7"></span>
            </span>
                    </button>
                    <button type="button" class="btn btn-primary" data-method="move" data-option="0" data-second-option="10" title="Move Down">
            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.move(0, 10)">
              <span class=" icon-arrow-down7"></span>
            </span>
                    </button>
                </div>

                <div class="btn-group">
                    <button type="button" class="btn btn-primary" data-method="rotate" data-option="-45" title="Rotate Left">
            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.rotate(-45)">
              <i class="icon-rotate-ccw2"></i>
            </span>
                    </button>
                    <button type="button" class="btn btn-primary" data-method="rotate" data-option="45" title="Rotate Right">
            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.rotate(45)">
              <i class=" icon-rotate-cw2"></i>
            </span>
                    </button>
                </div>

                <div class="btn-group">
                    <button type="button" class="btn btn-primary" data-method="scaleX" data-option="-1" title="Flip Horizontal">
            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.scaleX(-1)">
              <span class=" icon-arrow-resize7"></span>
            </span>
                    </button>
                    <button type="button" class="btn btn-primary" data-method="scaleY" data-option="-1" title="Flip Vertical">
            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.scaleY(-1)">
              <span class="icon-arrow-resize8"></span>
            </span>
                    </button>
                </div>

                <div class="btn-group">
                    <button type="button" class="btn btn-primary" data-method="crop" title="Crop">
            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.crop()">
              <span class=" icon-checkmark4"></span>
            </span>
                    </button>
                    <button type="button" class="btn btn-primary" data-method="clear" title="Clear">
            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.clear()">
              <span class=" icon-x"></span>
            </span>
                    </button>
                </div>

                <div class="btn-group">
                    <button type="button" class="btn btn-primary" data-method="disable" title="Disable">
            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.disable()">
              <span class=" icon-lock2"></span>
            </span>
                    </button>
                    <button type="button" class="btn btn-primary" data-method="enable" title="Enable">
            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.enable()">
              <span class="icon-unlocked2"></span>
            </span>
                    </button>
                </div>

                <div class="btn-group">
                    <button type="button" class="btn btn-primary" data-method="reset" title="Reset">
            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.reset()">
              <span class="icon-sync"></span>
            </span>
                    </button>

                    <button type="button" class="btn btn-primary" data-method="destroy" title="Destroy">
            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.destroy()">
              <span class=" icon-switch"></span>
            </span>
                    </button>
                </div>

                <div class="btn-group btn-group-crop">
                    <button type="button" class="btn btn-primary" data-method="getCroppedCanvas">
            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.getCroppedCanvas()">
              Get Cropped Canvas
            </span>
                    </button>
                    <button type="button" class="btn btn-primary" data-method="getCroppedCanvas" data-option="{ &quot;width&quot;: 160, &quot;height&quot;: 90 }">
            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.getCroppedCanvas({ width: 160, height: 90 })">
              160&times;90
            </span>
                    </button>
                    <button type="button" class="btn btn-primary" data-method="getCroppedCanvas" data-option="{ &quot;width&quot;: 320, &quot;height&quot;: 180 }">
            <span class="docs-tooltip" data-toggle="tooltip" title="cropper.getCroppedCanvas({ width: 320, height: 180 })">
              320&times;180
            </span>
                    </button>
                </div>

                <!-- Show the cropped image in modal -->
                <div class="modal fade docs-cropped" id="getCroppedCanvasModal" role="dialog" aria-hidden="true" aria-labelledby="getCroppedCanvasTitle" tabindex="-1">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                <h4 class="modal-title" id="getCroppedCanvasTitle">Cropped</h4>
                            </div>
                            <div class="modal-body"></div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                <a class="btn btn-primary" id="download" href="javascript:void(0);" download="cropped.jpg">Download</a>
                            </div>
                        </div>
                    </div>
                </div><!-- /.modal -->

                <button type="button" class="btn btn-primary" data-method="getData" data-option data-target="#putData">
          <span class="docs-tooltip" data-toggle="tooltip" title="cropper.getData()">
            Get Data
          </span>
                </button>
                <button type="button" class="btn btn-primary" data-method="setData" data-target="#putData">
          <span class="docs-tooltip" data-toggle="tooltip" title="cropper.setData(data)">
            Set Data
          </span>
                </button>

                <button type="button" class="btn btn-primary" data-method="getCanvasData" data-option data-target="#putData">
          <span class="docs-tooltip" data-toggle="tooltip" title="cropper.getCanvasData()">
            Get Canvas Data
          </span>
                </button>
                <button type="button" class="btn btn-primary" data-method="setCanvasData" data-target="#putData">
          <span class="docs-tooltip" data-toggle="tooltip" title="cropper.setCanvasData(data)">
            Set Canvas Data
          </span>
                </button>
                <button type="button" class="btn btn-primary" data-method="getCropBoxData" data-option data-target="#putData">
          <span class="docs-tooltip" data-toggle="tooltip" title="cropper.getCropBoxData()">
            Get Crop Box Data
          </span>
                </button>
                <button type="button" class="btn btn-primary" data-method="setCropBoxData" data-target="#putData">
          <span class="docs-tooltip" data-toggle="tooltip" title="cropper.setCropBoxData(data)">
            Set Crop Box Data
          </span>
                </button>

                <input type="text" class="form-control" id="putData" placeholder="Get data to here or set data with this value">

            </div><!-- /.docs-buttons -->

            <div class="col-md-3 docs-toggles">
                <!-- <h3 class="page-header">Toggles:</h3> -->
                <div class="btn-group btn-group-justified" data-toggle="buttons">
                    <label class="btn btn-primary active">
                        <input type="radio" class="sr-only" id="aspectRatio1" name="aspectRatio" value="1.7777777777777777">
            <span class="docs-tooltip" data-toggle="tooltip" title="aspectRatio: 16 / 9">
              16:9
            </span>
                    </label>
                    <label class="btn btn-primary">
                        <input type="radio" class="sr-only" id="aspectRatio2" name="aspectRatio" value="1.3333333333333333">
            <span class="docs-tooltip" data-toggle="tooltip" title="aspectRatio: 4 / 3">
              4:3
            </span>
                    </label>
                    <label class="btn btn-primary">
                        <input type="radio" class="sr-only" id="aspectRatio3" name="aspectRatio" value="1">
            <span class="docs-tooltip" data-toggle="tooltip" title="aspectRatio: 1 / 1">
              1:1
            </span>
                    </label>
                    <label class="btn btn-primary">
                        <input type="radio" class="sr-only" id="aspectRatio4" name="aspectRatio" value="0.6666666666666666">
            <span class="docs-tooltip" data-toggle="tooltip" title="aspectRatio: 2 / 3">
              2:3
            </span>
                    </label>
                    <label class="btn btn-primary">
                        <input type="radio" class="sr-only" id="aspectRatio5" name="aspectRatio" value="NaN">
            <span class="docs-tooltip" data-toggle="tooltip" title="aspectRatio: NaN">
              Free
            </span>
                    </label>
                </div>

                <div class="btn-group btn-group-justified" data-toggle="buttons">
                    <label class="btn btn-primary active">
                        <input type="radio" class="sr-only" id="viewMode0" name="viewMode" value="0" checked>
            <span class="docs-tooltip" data-toggle="tooltip" title="View Mode 0">
              VM0
            </span>
                    </label>
                    <label class="btn btn-primary">
                        <input type="radio" class="sr-only" id="viewMode1" name="viewMode" value="1">
            <span class="docs-tooltip" data-toggle="tooltip" title="View Mode 1">
              VM1
            </span>
                    </label>
                    <label class="btn btn-primary">
                        <input type="radio" class="sr-only" id="viewMode2" name="viewMode" value="2">
            <span class="docs-tooltip" data-toggle="tooltip" title="View Mode 2">
              VM2
            </span>
                    </label>
                    <label class="btn btn-primary">
                        <input type="radio" class="sr-only" id="viewMode3" name="viewMode" value="3">
            <span class="docs-tooltip" data-toggle="tooltip" title="View Mode 3">
              VM3
            </span>
                    </label>
                </div>

                <div class="dropdown dropup docs-options">
                    <button type="button" class="btn btn-primary btn-block dropdown-toggle" id="toggleOptions" data-toggle="dropdown" aria-expanded="true">
                        Toggle Options
                        <span class="caret"></span>
                    </button>
                    <ul class="dropdown-menu" role="menu" aria-labelledby="toggleOptions">
                        <li role="presentation">
                            <label class="checkbox-inline">
                                <input type="checkbox" name="responsive" checked>
                                responsive
                            </label>
                        </li>
                        <li role="presentation">
                            <label class="checkbox-inline">
                                <input type="checkbox" name="restore" checked>
                                restore
                            </label>
                        </li>
                        <li role="presentation">
                            <label class="checkbox-inline">
                                <input type="checkbox" name="checkCrossOrigin" checked>
                                checkCrossOrigin
                            </label>
                        </li>
                        <li role="presentation">
                            <label class="checkbox-inline">
                                <input type="checkbox" name="checkOrientation" checked>
                                checkOrientation
                            </label>
                        </li>

                        <li role="presentation">
                            <label class="checkbox-inline">
                                <input type="checkbox" name="modal" checked>
                                modal
                            </label>
                        </li>
                        <li role="presentation">
                            <label class="checkbox-inline">
                                <input type="checkbox" name="guides" checked>
                                guides
                            </label>
                        </li>
                        <li role="presentation">
                            <label class="checkbox-inline">
                                <input type="checkbox" name="center" checked>
                                center
                            </label>
                        </li>
                        <li role="presentation">
                            <label class="checkbox-inline">
                                <input type="checkbox" name="highlight" checked>
                                highlight
                            </label>
                        </li>
                        <li role="presentation">
                            <label class="checkbox-inline">
                                <input type="checkbox" name="background" checked>
                                background
                            </label>
                        </li>

                        <li role="presentation">
                            <label class="checkbox-inline">
                                <input type="checkbox" name="autoCrop" checked>
                                autoCrop
                            </label>
                        </li>
                        <li role="presentation">
                            <label class="checkbox-inline">
                                <input type="checkbox" name="movable" checked>
                                movable
                            </label>
                        </li>
                        <li role="presentation">
                            <label class="checkbox-inline">
                                <input type="checkbox" name="rotatable" checked>
                                rotatable
                            </label>
                        </li>
                        <li role="presentation">
                            <label class="checkbox-inline">
                                <input type="checkbox" name="scalable" checked>
                                scalable
                            </label>
                        </li>
                        <li role="presentation">
                            <label class="checkbox-inline">
                                <input type="checkbox" name="zoomable" checked>
                                zoomable
                            </label>
                        </li>
                        <li role="presentation">
                            <label class="checkbox-inline">
                                <input type="checkbox" name="zoomOnTouch" checked>
                                zoomOnTouch
                            </label>
                        </li>
                        <li role="presentation">
                            <label class="checkbox-inline">
                                <input type="checkbox" name="zoomOnWheel" checked>
                                zoomOnWheel
                            </label>
                        </li>
                        <li role="presentation">
                            <label class="checkbox-inline">
                                <input type="checkbox" name="cropBoxMovable" checked>
                                cropBoxMovable
                            </label>
                        </li>
                        <li role="presentation">
                            <label class="checkbox-inline">
                                <input type="checkbox" name="cropBoxResizable" checked>
                                cropBoxResizable
                            </label>
                        </li>
                        <li role="presentation">
                            <label class="checkbox-inline">
                                <input type="checkbox" name="toggleDragModeOnDblclick" checked>
                                toggleDragModeOnDblclick
                            </label>
                        </li>
                    </ul>

                </div><!-- /.dropdown -->
                <form action="{{ route('gallery_unit_crop',['id'=>$content->id]) }}" method="post" onsubmit="return Main.formSubmit(this);">
                    <input type="hidden" name="data_crop_info" id="imageInfo">
                    <input type="hidden" name="data_crop" id="putDataHidden">
                    <div class="text-right">
                        <button type="submit" class="btn btn-primary">{{ trans('app.submit') }} <i class="icon-arrow-right14 position-right"></i></button>
                    </div>
                </form>

            </div><!-- /.docs-toggles -->
        </div>
    </div>

    <script>
        window.onload = function () {

            'use strict';

            var Cropper = window.Cropper;
            var console = window.console || { log: function () {} };
            var container = document.querySelector('.img-container');
            var image = container.getElementsByTagName('img').item(0);
            var download = document.getElementById('download');
            var actions = document.getElementById('actions');
            var dataX = document.getElementById('dataX');
            var dataY = document.getElementById('dataY');
            var dataHeight = document.getElementById('dataHeight');
            var dataWidth = document.getElementById('dataWidth');
            var dataRotate = document.getElementById('dataRotate');
            var dataScaleX = document.getElementById('dataScaleX');
            var dataScaleY = document.getElementById('dataScaleY');
            var isUndefined = function (obj) {
                return typeof obj === 'undefined';
            };

            var options = {
                preview: '.img-preview',
                checkImageOrigin: false,
                checkCrossOrigin: false,
                @if($content->data_crop_info)
                    canvasData: {!! $content->data_crop_info !!} ,
                @endif
                @if($content->data_crop)
                    data: {!! $content->data_crop !!} ,
                @endif
                build: function (e) {

                },
                built: function (e) {
                    $('#putData').val(JSON.stringify(cropper.getData()));
                    $('#putDataHidden').val(JSON.stringify(cropper.getData()));
                    $('#imageInfo').val(JSON.stringify(cropper.getCanvasData()));
                },
                cropstart: function (e) {
                   // console.log(e.type, e.detail.action);
                },
                cropmove: function (e) {
                   // console.log(e.type, e.detail.action);
                },
                cropend: function (e) {
                   // console.log(e.type, e.detail.action);
                },
                crop: function (e) {
                    var data = e.detail;
                    $('#putData').val(JSON.stringify(cropper.getData()));
                    $('#putDataHidden').val(JSON.stringify(cropper.getData()));
                    $('#imageInfo').val(JSON.stringify(cropper.getCanvasData()));
                    dataX.value = Math.round(data.x);
                    dataY.value = Math.round(data.y);
                    dataHeight.value = Math.round(data.height);
                    dataWidth.value = Math.round(data.width);
                    dataRotate.value = !isUndefined(data.rotate) ? data.rotate : '';
                    dataScaleX.value = !isUndefined(data.scaleX) ? data.scaleX : '';
                    dataScaleY.value = !isUndefined(data.scaleY) ? data.scaleY : '';
                },
                zoom: function (e) {
                    console.log(e.type, e.detail.ratio);
                }
            };
            var cropper = new Cropper(image, options);

            function preventDefault(e) {
                if (e) {
                    if (e.preventDefault) {
                        e.preventDefault();
                    } else {
                        e.returnValue = false;
                    }
                }
            }


            // Tooltip
            $('[data-toggle="tooltip"]').tooltip();


            // Buttons
            if (!document.createElement('canvas').getContext) {
                $('button[data-method="getCroppedCanvas"]').prop('disabled', true);
            }

            if (typeof document.createElement('cropper').style.transition === 'undefined') {
                $('button[data-method="rotate"]').prop('disabled', true);
                $('button[data-method="scale"]').prop('disabled', true);
            }


            // Download
            if (typeof download.download === 'undefined') {
                download.className += ' disabled';
            }


            // Options
            actions.querySelector('.docs-toggles').onclick = function (event) {
                var e = event || window.event;
                var target = e.target || e.srcElement;
                var cropBoxData;
                var canvasData;
                var isCheckbox;
                var isRadio;

                if (!cropper) {
                    return;
                }

                if (target.tagName.toLowerCase() === 'span') {
                    target = target.parentNode;
                }

                if (target.tagName.toLowerCase() === 'label') {
                    target = target.getElementsByTagName('input').item(0);
                }

                isCheckbox = target.type === 'checkbox';
                isRadio = target.type === 'radio';

                if (isCheckbox || isRadio) {
                    if (isCheckbox) {
                        options[target.name] = target.checked;
                        cropBoxData = cropper.getCropBoxData();
                        canvasData = cropper.getCanvasData();

                        options.built = function () {
                            console.log('built');
                            cropper.setCropBoxData(cropBoxData).setCanvasData(canvasData);
                        };
                    } else {
                        options[target.name] = target.value;
                        options.built = function () {
                            console.log('built');
                        };
                    }

                    // Restart
                    cropper.destroy();
                    cropper = new Cropper(image, options);
                }
            };


            // Methods
            actions.querySelector('.docs-buttons').onclick = function (event) {
                var e = event || window.event;
                var target = e.target || e.srcElement;
                var result;
                var input;
                var data;

                if (!cropper) {
                    return;
                }

                while (target !== this) {
                    if (target.getAttribute('data-method')) {
                        break;
                    }

                    target = target.parentNode;
                }

                if (target === this || target.disabled || target.className.indexOf('disabled') > -1) {
                    return;
                }

                data = {
                    method: target.getAttribute('data-method'),
                    target: target.getAttribute('data-target'),
                    option: target.getAttribute('data-option'),
                    secondOption: target.getAttribute('data-second-option')
                };

                if (data.method) {
                    if (typeof data.target !== 'undefined') {
                        input = document.querySelector(data.target);

                        if (!target.hasAttribute('data-option') && data.target && input) {
                            try {
                                data.option = JSON.parse(input.value);
                            } catch (e) {
                                console.log(e.message);
                            }
                        }
                    }

                    if (data.method === 'getCroppedCanvas') {
                        data.option = JSON.parse(data.option);
                    }

                    result = cropper[data.method](data.option, data.secondOption);

                    switch (data.method) {
                        case 'scaleX':
                        case 'scaleY':
                            target.setAttribute('data-option', -data.option);
                            break;

                        case 'getCroppedCanvas':
                            if (result) {

                                // Bootstrap's Modal
                                $('#getCroppedCanvasModal').modal().find('.modal-body').html(result);

                                if (!download.disabled) {
                                    download.href = result.toDataURL('image/jpeg');
                                }
                            }

                            break;

                        case 'destroy':
                            $('#putDataHidden').val('');
                            $('#imageInfo').val('');
                            cropper = null;
                            break;
                    }

                    if (typeof result === 'object' && result !== cropper && input) {
                        try {
                            input.value = JSON.stringify(result);
                        } catch (e) {
                            console.log(e.message);
                        }
                    }

                }
            };

            document.body.onkeydown = function (event) {
                var e = event || window.event;

                if (!cropper || this.scrollTop > 300) {
                    return;
                }

                switch (e.charCode || e.keyCode) {
                    case 37:
                        preventDefault(e);
                        cropper.move(-1, 0);
                        break;

                    case 38:
                        preventDefault(e);
                        cropper.move(0, -1);
                        break;

                    case 39:
                        preventDefault(e);
                        cropper.move(1, 0);
                        break;

                    case 40:
                        preventDefault(e);
                        cropper.move(0, 1);
                        break;
                }
            };


        };
    </script>

@endsection
