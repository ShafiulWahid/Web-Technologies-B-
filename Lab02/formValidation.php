<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<title> </title>
</head> 
<body>



<?php
 $nameErr = "";
 $emailErr ="";
 $dobErr="";
 $genderErr ="";
 $degreeErr="";
 $bloodGroupErr = "";
 $name ="";
 $email ="";
 $dd ="";
 $mm="";
 $yyyy="";
 $gender ="";
 $degree="";
 $bloodGroup="";

         /*VALIDATION*/

 /*Name*/

  if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (empty($_POST["name"])) {
      $nameErr = "Name is required";
    } else {
      $name = test_input($_POST["name"]);

      if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
        $nameErr = "Only letters and white space allowed";
      }
    }


   /*Email*/

    if (empty($_POST["email"])) {
      $emailErr = "Email is required";
    } else {
      $email = test_input($_POST["email"]);
      
      if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $emailErr = "Invalid email format";
      }
    }



       /*DOB*/


       if(empty($_POST["dd"]) or empty($_POST["mm"]) or empty($_POST["yyyy"]))
    {
    $dobErr="Full Date of birth input is requied";
    $dd = test_input($_POST["dd"]);
    $mm = test_input($_POST["mm"]);
    $yyyy = test_input($_POST["yyyy"]);

  }
  else
  {
    $dd = test_input($_POST["dd"]);
    $mm = test_input($_POST["mm"]);
    $yyyy = test_input($_POST["yyyy"]);

    if( !filter_var($dd,FILTER_VALIDATE_INT,array('options' => array(
            'min_range' => 1, 'max_range' => 31)))|
            !filter_var($mm,FILTER_VALIDATE_INT,array('options' => array(
            'min_range' => 1, 'max_range' => 12)))|
            !filter_var($yyyy,FILTER_VALIDATE_INT,array('options' => array(
            'min_range' => 1953, 'max_range' => 1998)))
        )
        
      {$dobErr="Must be valid numbers(dd:1-31,mm: 1-12,yyyy: 1953-1998)";}
  }


/* Gender*/

    if (empty($_POST["gender"])) {
      $genderErr = "Gender is required";
    } else {
      $gender = test_input($_POST["gender"]);
    }
  

/*Degree*/

  if(!isset($_POST["degree"]))
  {
    $degreeErr="";    
  }
  else if (sizeof($_POST["degree"])<2)
  {
    $degreeErr="At least two must be selected";
  }


/* BloodGROUP*/

if(!isset($_POST["bloodGroup"]))
  {
    $bloodGroupErr="Must be selected";
  }
  else
  {
    if($_POST["bloodGroup"]=="blank")
    {
      $bloodGroupErr="Must be selected";
    }
  }


}


  function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
  }

  ?>

      <!--FORM--> 


	<form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']) ;  ?>" method= "post">  
     
     <!-- NAME-->

    <label> 1. </label>
	<fieldset style="width: 500px"> 
              <legend > NAME</legend>
              <input type="text" name="name"> <span class=" err">*
                <?php 

                    
                      echo "$nameErr";
                    

                ?>

              </span>
              
              <hr> 

	 </fieldset> <br> 

<!-- Email-->

 <label> 2. </label>
 <fieldset style="width:500px">
 	<legend>EMAIL </legend>
 	<input type="EMAIL" name="email" > <span class="err">*
    <?php
          if (isset($emailErr)) {
            
            echo $emailErr;
          }

    ?>
    
  </span>
 	<hr> 
 </fieldset > <br> 

 <!--DOB-->

 <label> 3. </label>
 
<fieldset style="width: 500px; ">
<legend>DATE OF BIRTH</legend>
<table>
<tr>
  <th style="font-weight: normal;"><label for="dd" >dd</label></th>
  <th></th>
  <th style="font-weight: normal;"><label for="mm" >mm</label></th>
  <th></th>
  <th style="font-weight: normal;"><label for="yyyy" >yyyy</label></th>
  <th></th>
</tr>
<tr>
<td><input type="text" name="dd" style="width: 30px" value="<?php echo $dd;?>"></td>
<td>/</td>
<td><input type="text" name="mm" style="width: 30px" value="<?php echo $mm;?>"></td>
<td>/</td>
<td><input type="text" name="yyyy" style="width: 30px;" value="<?php echo $yyyy;?>"></td>
<td style="padding-left: 10px"><span class="err">* <?php echo $dobErr;?></span></td>
</tr>
</table>
<hr>

</fieldset>

  <br>

  <!--GENDER--> 

 <label> 4. </label>
 <fieldset style="width:500px"> 
    
<legend> GENDER</legend>
<input type="radio" name="gender" value="female">Female
    <input type="radio" name="gender" value="male">Male
    <input type="radio" name="gender" value="other">Other
    <span class="err">*
    <?php 
      if (isset($genderErr)) {
        echo $genderErr; 
      }
      ?>
      </span>

<hr>

  </fieldset> <br>

  <!--DEGREE--> 

  <label>5. </label>
  <fieldset style="width:500px">

                <legend>DEGREE</legend>

               <input type="checkbox" id="degree" name="degree[]" value="ssc"> SSC
  <input type="checkbox" id="degree" name="degree[]" value="hsc"> HSC
  <input type="checkbox" id="degree" name="degree[]" value="bsc"> BSc
  <input type="checkbox" id="degree" name="degree[]" value="msc"> MSc
  <br>  
  <span class="err" >* 

    <?php echo $degreeErr;

    ?></span>      


      </fieldset><br>

      <!--BLOODGROUP-->

      <label> 6. </label>

   <fieldset style="width: 500px; ">
<legend> BLOOD GROUP</legend>
  <select name="bloodGroup" id="bloodGroup">
    <option value="blank">Select</option>
    <option value="AB+">AB+</option>
    <option value="AB-">AB-</option>
    <option value="A+">A+</option>
    <option value="A-">A-</option>
    <option value="B+">B+</option>
    <option value="B-">B-</option>
    <option value="O+">O+</option>
    <option value="O-">O-</option>
  </select> 
  <br>  
  <span class="err" >* <?php echo $bloodGroupErr;?></span>  

      </fieldset>
  
  <input type="submit" name="">
  
 </form>

</body>
</html>