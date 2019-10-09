<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<style>
  @page { margin: 0in; }
  body {
    font-family: Denk One, sans-serif;
    background-image: url(https://res.cloudinary.com/wishaft/image/upload/v1557420554/backgroundpdfQR.png);
    background-position: top left;
    background-repeat: no-repeat;
    background-size: 100%;
    padding: 300px 100px 10px 100px;
    width:100%;
    height:100%;
    margin-top: 100px;
    margin-left:100px;
  }
  #qrcode{
    background-color:red;
    float: right;
 
  }
</style>
</head>
<body>
  <div id="qrcode">
    <img src="data:image/png;base64, {{ base64_encode(QrCode::format('png')->size(250)->generate($id)) }} ">
  </div>
</body>
</html>
