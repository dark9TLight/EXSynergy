<?php 
if(isset($_POST['calculate'])){
    $regNo = $_POST['regNo'];
    $inDate = new DateTime($_POST['inDate']);
    $outDate = new DateTime($_POST['outDate']);

    // Check if inDate and outDate are set in the $_POST array
    if(isset($_POST['inDate']) && isset($_POST['outDate'])){
        // Create DateTime objects from user input
        $inDate = new DateTime($_POST['inDate']);
        $outDate = new DateTime($_POST['outDate']);

        // Compare the dates
        if($inDate > $outDate){
            die("In date must be less than Out date"); // Terminate the script with an error message

        } else {
            // Initialize an empty array to store the dates
            $dateArray = array();

            $countdateArray = 0;
            $countWeek = 0;
            // Iterate over the dates from $inDate to $outDate and add them to the $dateArray
            while ($inDate <= $outDate) {
                // Format the date as per your requirement
                $formattedDate = $inDate->format('Y-m-d H:i');
                
                // Add the formatted date to the array
                $dateArray[] = $formattedDate;

                // Check if the formatted date is a weekend (Saturday or Sunday)
                if (date('N', strtotime($formattedDate)) >= 6) {
                    // Add the formatted date to the weekend dates array
                    $dateArrayWeek[$countWeek] = "weekend";
                } else {
                    // Add the formatted date to the weekday dates array
                    $dateArrayWeek[$countWeek] = "weekday";
                }

                // Move to the next date
                $inDate->modify('+1 day'); // You can modify this to any interval you want

                $countdateArray++;
                $countWeek++;
            }

            $inDateString = $inDate->format('Y-m-d H:i');
            $outDateString = $outDate->format('Y-m-d H:i');

            // Extract hour value using DateTime object
            $outHour = $outDate->format('H');

            echo "<br><strong>Registration Number:</strong> $regNo<br>";
            echo "<br><strong>In:</strong> $dateArray[0]<br>";
            echo "<br><strong>Out:</strong> $outDateString<br><br>";

            $minutes = calculateMinute($inDate, $outDate);
            $totalHours = calculateTotalHours($dateArray, $outDateString);

            echo "<strong>Duration:</strong> $totalHours hours $minutes minutes<br><br>";

            $dayfee = 0;
            for($i = 0; $i < ($countdateArray - 1); $i++ ){

                if($dateArrayWeek[$i] == "weekday"){
                    $dayfee += 20;

                }else if($dateArrayWeek[$i] == "weekend"){
                    $dayfee += 40;
                }
            }
        }
        $countWeek--; // Decrement the counter to get the last valid index
            // Calculate the result based on the last date in the array
            if($totalHours > 24){
                if($dateArrayWeek[$countWeek] == "weekday"){
                    $result = $dayfee + ($outHour * 1.50);
                }else if($dateArrayWeek[$countWeek] == "weekend"){
                    $result = $dayfee + ($outHour * 2.0);
                }else{
                    // Handle the case when the last date is not categorized as weekday or weekend
                    $result = 0; // or set a default value based on your requirements
                }
            }
            else if($totalHours == 0 && $minutes <= 15){
                echo "<br><strong>Amount to paid:</strong>$ 0.00<br><br>";
                die();
            } 
            else if($dateArrayWeek[$countWeek] == "weekday"){
                //$result = $dayfee;
                $resultFee = calculateWeekdayHourlyRate($totalHours);
                $result = $resultFee;
            }
            else if($dateArrayWeek[$countWeek] == "weekend"){
                $resultFee = calculateWeekendHourlyRate($totalHours);
                $result = $resultFee;
            }
            echo "<br><br><strong>Amount to paid:</strong> $ $result <br><br>";
            }
            } else {
                echo "Invalid input"; // Handle the case when inDate or outDate is not set in $_POST
            }
?>