<!DOCTYPE html>
<html>
<head>
<meta content="width=device-width, initial-scale=1">
<style>
body {
  font-family: "Lato", sans-serif;
  margin-top: 0px;
  background-image: url("C:/Users/jorda/OneDrive/Desktop/yes.jpg");
  margin:auto;
}
.header {
  background-color:#111;
  padding: 30px;
  text-align: center;
  font-size: 35px;
  font-style: bold;
  color: #818181;
  margin-top: 0%;
  margin-right: 0%;
}

.default{
    text-align: center;
    font-size: 20px;
    color:white;
    text-shadow:
    -1px -1px 0 #000,
    1px -1px 0 #000,
    -1px 1px 0 #000,
    1px 1px 0 #000; 
}

.inputDesign{
    text-align: center;
    width: 50%;
    height:30px;
    margin:auto;
}

.sidenav {
  height: 100%;
  width: 160px;
  position: fixed;
  z-index: 1;
  top: 0;
  left: 0;
  background-color: #111;
  overflow-x: hidden;
  padding-top: 100px;
}

.sidenav a{
  padding: 6px 8px 6px 16px;
  text-decoration: none;
  font-size: 25px;
  color: #818181;
  display: block;
}

.sidenav a:hover{
  color: #f1f1f1;
}

.main{
  margin-left: 160px; 
  font-size: 28px;
  padding: 0px 10px;
}

@media screen and (max-height: 450px) {
  .sidenav {padding-top: 30px;}
  .sidenav a {font-size: 18px;}
}
</style>
</head>
<body>
    <h2 class="header">Hockey Player Database</h2>
<div class="inputDesign">
    <input class="inputDesign" type="text" placeholder="Search..">
</div>
<div class="sidenav">
  <a href="#about">Home</a>
  <a href="#services">Services</a>
  <a href="#clients">View</a>
  <a href="#contact">About</a>
</div>

<div class="main">
    <p class="default">This is a COSC 471 hockey player database</p>
    <p class="default">It uses html, css, php, and mySQL to create a database </p>
</div>
</body>
</html>