<html>
<style>
/* Styles the middle center of the page */
.content{
  height:600px;
  width:400px;
  background-color:#e1f7d5;
  box-shadow: 10px 10px 20px 10px black;
  border: 4px outset grey;
  position: fixed;
  top:22%;
  left:38%;
  text-align: center;
  font-size:18px;
  margin: auto;
  }
  /* styles the body of the page */
body{
background-color:#e6bbad;
}
/* Styles the bottom part of the page */
.bottomfooter
{
background-color:#e6bbad;
overflow:hidden;
position:fixed;
color:white;
text-align:center;
left:0;
bottom:0;
width:100%
}
/*.topnav styles the topbar of the webpage */
.topnav {
position:absolute;
top:0;
left:0;
right:0;
  overflow: hidden;
  background-color: #99cfe0;
}

.topnav a {
  float: left;
  color: #f2f2f2;
  text-align: center;
  padding: 14px 16px;
  text-decoration: none;
  font-size: 17px;
}

.topnav a:hover {
  background-color: #ddd;
  color: black;
}

.topnav a.active {
  background-color: #04AA6D;
  color: white;
}
</style>
<body>
<div class="topnav">
  <a class="active" href="http://localhost/435project/mainpage.php">Home</a>
  <a href="http://localhost/435project/contact.php">Contact</a>
</div>
<div class = "content">
<h1>Contact us at:</h1>
<p> christopher.WU03@myhunter.cuny.edu</p>
<h2> OR: </h2>
<p>terry.phung20@myhunter.cuny.edu</p>
</div>
</body>
<footer class = "bottomfooter">
<p>All Rights Reserved @2021</p>
</footer>
</html>