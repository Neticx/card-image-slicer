<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?><!DOCTYPE html>
<html lang="en">
    <head>
        <title>Image Slicer</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
    </head>
    <body>
        <div class="jumbotron">
            <div class="row text-center">
                <div class="col-sm-5">
                    <h3>Camera</h3>
                </div>
                <div class="col-sm-2">
                    <div class="btn-group" id="options" data-toggle="buttons">
                        <label class="btn btn-default active">
                            <input type="radio" name ="card" id="card1" value="KTP" checked>KTP
                        </label>
                        <label class="btn btn-default" >
                            <input type="radio" name ="card" id="card2" value="SIM" >SIM
                        </label>
                    </div>
                </div>
                <div class="col-sm-5">
                    <h3>Full Result</h3>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <video class="margin-left-45" id="video" width="640" height="480" autoplay></video>
                </div>
                <div class="col-sm-6">
                    <canvas class="margin-left-45" id="full" width="640" height="480"></canvas>
                </div>
            </div>
            <div class="row text-center clearfix">
                <button class="btn btn-danger btn-lg" id="snap"><i class="fa fa-camera" aria-hidden="true"></i> CAPTURE</button>
            </div>

            <div class="row clearfix text-center">
                <h2>  Sub Results  </h2>
            </div>
            <div class="row">
                <div class="col-sm-3 form-group">
                    <label for="photo" class="control-label">Photo</label> <br>
                    <canvas id="photo" width="240" height="320"></canvas>
                </div>
                <div class="col-sm-4">
                    <div class="col-sm-12">
                        <label for="number">Number</label>
                        <canvas id="number" width="400" height="30"></canvas>
                    </div>
                    <div class="col-sm-12">
                        <label for="name">Holder Name</label>
                        <canvas id="name" width="400" height="30"></canvas>
                    </div>
                    <div class="col-sm-12">
                        <label for="address1">Address 1</label>
                        <canvas id="address1" width="400" height="30"></canvas>
                    </div>
                    <div class="col-sm-12">
                        <label for="address2">Address 2</label>
                        <canvas id="address2" width="400" height="30"></canvas>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="col-sm-12">
                        <label for="address3">Address 3</label>
                        <canvas id="address3" width="400" height="30"></canvas>
                    </div>
                    <div class="col-sm-12">
                        <label for="address4">Address 4</label>
                        <canvas id="address4" width="400" height="30"></canvas>
                    </div>
                    <div class="col-sm-12">
                        <label for="expired">Expired</label>
                        <canvas id="expired" width="400" height="30"></canvas>
                    </div>
                </div>
            </div>

            <div class="row clearfix text-center">
                <button class="btn btn-lg btn-primary"><i class="fa fa-save"></i> Save</button>
            </div>
        </div>

        <script>
            // Grab elements, create settings, etc.
            var video = document.getElementById('video');

            // Get access to the camera!
            if(navigator.mediaDevices && navigator.mediaDevices.getUserMedia) {
                // Not adding `{ audio: true }` since we only want video now
                navigator.mediaDevices.getUserMedia({ video: true }).then(function(stream) {
                    //video.src = window.URL.createObjectURL(stream);
                    video.srcObject = stream;
                    video.play();
                });
            }

            var video = document.getElementById('video');

            // full capture
            var full = document.getElementById('full');
            var fullCtx = full.getContext('2d');

            // No SIM/KTP
            var number = document.getElementById('number');
            var numberCtx = number.getContext('2d');

            // Name
            var holder = document.getElementById('name');
            var nameCtx = holder.getContext('2d');

            // photo
            var photo = document.getElementById('photo');
            var photoCtx = photo.getContext('2d');

            // address 1
            var address1 = document.getElementById('address1');
            var address1Ctx = address1.getContext('2d');

            // address 2
            var address2 = document.getElementById('address2');
            var address2Ctx = address2.getContext('2d');

            // address 3
            var address3 = document.getElementById('address3');
            var address3Ctx = address3.getContext('2d');

            // address 4
            var address4 = document.getElementById('address4');
            var address4Ctx = address4.getContext('2d');

            // expired
            var expired = document.getElementById('expired');
            var expiredCtx = expired.getContext('2d');

            // Trigger photo take
            document.getElementById("snap").addEventListener("click", function() {
                var card_type = $("input[name='card']:checked").val();
                console.log(card_type);
                if (card_type == 'SIM'){
                    //SIM
                    fullCtx.drawImage(video, 0, 0, 640, 480); //full frame
                    numberCtx.clearRect(0, 0, 400,30);
                    numberCtx.drawImage(video,310,300,640,20,1,1,640,20); //NO SIM
                    nameCtx.clearRect(0, 0, 400,30);
                    nameCtx.drawImage(video,115,150,420,25,1,1,420,25); //name SIM
                    photoCtx.clearRect(0, 0, 400,30);
                    photoCtx.drawImage(video,1,195,170,200,1,1,170,200); //photo SIM
                    address1Ctx.clearRect(0, 0, 400,30);
                    address1Ctx.drawImage(video,160,175,640,20,1,1,640,20); //alamat SIM 1
                    address2Ctx.clearRect(0, 0, 400,30);
                    address2Ctx.drawImage(video,170,195,640,20,1,1,640,20); //alamat SIM 2
                    address3Ctx.clearRect(0, 0, 400,30);
                    address3Ctx.drawImage(video,170,215,640,20,1,1,640,20); //alamat SIM 3
                    address4Ctx.clearRect(0, 0, 400,30);
                    expiredCtx.drawImage(video,310,320,640,20,1,1,640,20); //EXPIRED SIM
                } else if (card_type == 'KTP'){
                    //KTP
                    fullCtx.drawImage(video, 0, 0, 640, 480); //full frame
                    numberCtx.clearRect(0, 0, 400,30) //NO KTP
                    numberCtx.drawImage(video,130,90,320,30,1,1,320,30); //NO KTP
                    nameCtx.clearRect(0, 0, 400,30);
                    nameCtx.drawImage(video,145,135,300,25,1,1,300,25); //name ktp
                    photoCtx.clearRect(0, 0, 400,30);
                    photoCtx.drawImage(video,460,120,170,200,1,1,170,200); //photo KTP
                    address1Ctx.clearRect(0, 0, 400,30);
                    address1Ctx.drawImage(video,145,200,300,20,1,1,300,20); //alamat KTP 1
                    address2Ctx.clearRect(0, 0, 400,30);
                    address2Ctx.drawImage(video,145,220,300,20,1,1,300,20); //alamat KTP 2
                    address3Ctx.clearRect(0, 0, 400,30);
                    address3Ctx.drawImage(video,145,240,300,20,1,1,300,20); //alamat KTP 3
                    address4Ctx.clearRect(0, 0, 400,30);
                    address4Ctx.drawImage(video,145,260,300,20,1,1,300,20); //alamat KTP 4
                    expiredCtx.clearRect(0, 0, 400,30);
                    expiredCtx.drawImage(video,145,365,300,20,1,1,300,20); //EXPIRED KTP
                }
            });
        </script>

        <style>
            .margin-left-45{
                margin: 0px 40px auto;
            }
            .clearfix{
                margin-top: 20px;
                margin-bottom: 20px;
            }
        </style>
    </body>
</html>