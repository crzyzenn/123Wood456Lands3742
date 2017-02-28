<?php

//load the database configuration file
include '../connect.php';
require 'buildAdmin.php';
error_reporting(E_ERROR | E_WARNING | E_PARSE);
if(isset($_POST['importSubmit'])){

    //validate whether uploaded file is a csv file
    $csvMimes = array('application/vnd.ms-excel','text/plain','text/csv','text/tsv');
    if(!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'],$csvMimes)){
        if(is_uploaded_file($_FILES['file']['tmp_name'])){

            //open uploaded csv file with read only mode
            $csvFile = fopen($_FILES['file']['tmp_name'], 'r');

            //skip first line
            fgetcsv($csvFile);

            //parse data from csv file line by line
            while(($line = fgetcsv($csvFile)) !== FALSE){
              //insert member data into database
              try{
                $array1 = ["'".$line[0]."'", "'".$line[1]."'", "'".$line[2]."'", "'".$line[3]."'", "'".$line[4]."'", "'".$line[5]."'", "'".$line[6]."'", "'".$line[7]."'", "'".$line[8]."'", "'".$line[9]."'", "'".$line[10]."'", "'".$line[11]."'", "'".$line[12]."'", "'".$line[13]."'", "'".$line[14]."'", "'".$line[15]."'", "'".$line[16]."'", "'".$line[17]."'", "'".$line[18]."'"];
                //Seperating the array in commas and assigning it to a string values
                $values = implode(",", $array1);

                //Update or insert
                $status = '';
                $id;
                $check = $connectSql->query("SELECT email, id FROM Application WHERE email ='$line[11]'");
                foreach ($check as $value) {
                  # code...
                  if (!empty($check)) {
                    # code...
                    $status = 'Update';
                    $id = $value['id'];
                  }
                  else{
                    $status = 'Dont';
                  }

                }

                //If duplicate values are found, update them
                if ($status == 'Update') {
                  # code..
                    $connectSql->query("UPDATE Application SET title='".$line[0]."', gender='".$line[1]."', firstname='".$line[2]."', surname='".$line[3]."', father_name='".$line[4]."', mother_name='".$line[5]."', dob='".$line[6]."', country='".$line[7]."', postal_code='".$line[8]."', home_telephone='".$line[9]."', mobile_telephone='".$line[10]."', email='".$line[11]."', recent_gpa='".$line[12]."', institute_name='".$line[13]."', passed_year='".$line[14]."', board_name='".$line[15]."', exam_number='".$line[16]."', uci='".$line[17]."', course_name='".$line[18]."' WHERE id = '$id'");
                    $qstring = '?status=succ';
                }

                //If no duplicate values, then insert them
                else {
                  # code...
                    $qstring = '?status=succ';
                  //Running the insert query into the Application table
                  $connectSql->query("INSERT INTO Application (title, gender, firstname, surname, father_name, mother_name, dob, country, postal_code, home_telephone, mobile_telephone, email, recent_gpa, institute_name, passed_year, board_name, exam_number, uci, course_name) VALUES ($values)");

                }

              }

              catch(Exception $e){
                echo "Error".$e->getMessage();
              }
            }
            //close opened csv file
            fclose($csvFile);

        }

        else{
            $qstring = '?status=err';
        }
    }else{
        $qstring = '?status=invalid_file';
    }
}

//redirect to the listing page with the string i.e. status (failed / error / success)
header("Location: uploadFile.php".$qstring);
