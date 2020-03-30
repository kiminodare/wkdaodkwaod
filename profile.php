<?php
session_start();
include 'test.php';
$id = $_SESSION['id'];
$query = "SELECT * FROM user WHERE id='$id'";
$result =@mysqli_query($koneksi,$query);
$row = mysqli_fetch_assoc($result);
?>

<style>
@import url('https://fonts.googleapis.com/css?family=Abril+Fatface|Josefin+Sans&display=swap');
body{
  background-image: linear-gradient(to right, #fff2f4, #ffe8eb, #ffdde1, #ffd3d6, #ffc9cb, #ffc4ca, #ffbfcb, #ffbacc, #fbbad9, #f4bce7, #e8c0f4, #d9c4ff);
  overflow-x: hidden!important;
  overflow-y: hidden!important;
  color: #212121;
  text-align:center;
}
img{
  /*image effect*/
  opacity:0.7;
  filter:blur(0.5px);
  /*-----*/
  position:relative;
  top:0;
  width:100%;
  height:auto;  
  margin:auto;
  position: 50% 50%;
  border-radius: 10px 10px 0px 0px;
  position: relative;
  margin:0; 
}

/*gradient profile pic*/
.image {
  border-radius: 10px 10px 0px 0px;
  background-image: linear-gradient(to right, #ff0000, #ff517f, #ff97d2, #f8d1fc, #ffffff);
}
/*------*/
.main{
  opacity:0.7;
  background-color: white;
  width: 100%;
  min-widht:50vh;
  max-width:300px;
  max-height: 570px;
  top:20px;
  box-shadow: 0px 8px 60px -10px rgba(13,28,39,0.6);
  border-radius: 10px;
  padding-bottom:16px;
  /*---*/
  position: fixed;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  position: 50% 50%;
  margin-left: auto;
  margin-right: auto;
}

.main:hover{
  opacity:1;
}
.stat{
  padding-top:30px;
  position: absolute;
  top: 8px;
  left: 16px;
  color:white;
  font-family: 'Josefin Sans';
  float: left;
  width: 10%;
  text-align:left;
}
.title{
  color:#FFCDD2;
}
span{
  line-height:2;
}
h1{
  font-family: 'Abril Fatface';
}
p, h3{
  font-family: 'Josefin Sans';
  line-height:1;
}
p{
  padding-right:10px;
  padding-left:10px;
}
.fa {
  padding: 10px;
  font-size: 20px;
  text-align: center;
  text-decoration: none;
  color:red;
}
.fa:hover {
  transform: scale(1.2);
}
/*next to location*/
svg{
  transform: translate(0, -30%);
  float:left;
}
.location{
  width: 30%;
  margin: 0 auto;
}





</style>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<div class="main">
  <div class="image"><img src="https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/ce4d3ce1-8ddc-41d8-8499-f8781586dfd1/ddbf68h-c731d440-b5ea-4a16-84f2-5e578497e52e.jpg/v1/fill/w_600,h_600,q_75,strp/p_o_r_t_a_l_by_ithar14_ddbf68h-fullview.jpg?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOjdlMGQxODg5ODIyNjQzNzNhNWYwZDQxNWVhMGQyNmUwIiwiaXNzIjoidXJuOmFwcDo3ZTBkMTg4OTgyMjY0MzczYTVmMGQ0MTVlYTBkMjZlMCIsIm9iaiI6W1t7ImhlaWdodCI6Ijw9NjAwIiwicGF0aCI6IlwvZlwvY2U0ZDNjZTEtOGRkYy00MWQ4LTg0OTktZjg3ODE1ODZkZmQxXC9kZGJmNjhoLWM3MzFkNDQwLWI1ZWEtNGExNi04NGYyLTVlNTc4NDk3ZTUyZS5qcGciLCJ3aWR0aCI6Ijw9NjAwIn1dXSwiYXVkIjpbInVybjpzZXJ2aWNlOmltYWdlLm9wZXJhdGlvbnMiXX0.G9DmLDmwTgJZM-JJlxmFbol2okInZQP_TX4hWi9Wywc"></div>
  <div class="stat">
   
  </div>
<div class=card>
  <h1><?php echo $_SESSION['username']; ?> </h1>
  <p>TOTAL CRE : <?php echo  $row['credit']; ?> </p>
  <div class="location">
  </div>
</div>