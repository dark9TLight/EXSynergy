<?php
function calculateWeekdayHourlyRate($totalHours){ //calculate hourly rate based on weekday
    if($totalHours >= 3){
        $hoursMinus3 = $totalHours - 3;
        $fees = 3;

        while($hoursMinus3>0){
            $fees += 1.5;
            if($fees > 20){
                $fees = 20;
                break;
            }
            $hoursMinus3--;
        }
    }
    return $fees;
}

function calculateWeekendHourlyRate($totalHours){ //calculate hourly rate based on weekend
    if($totalHours >= 3){
        $hoursMinus5 = $totalHours - 3;
        $fees = 5;

        while($hoursMinus5>0){
            $fees += 2.0;
            if($fees > 40){
                $fees = 40;
                break;
            }
            $hoursMinus5--;
        }
    }
    return $fees;
}

function calculateMinute($inDate, $outDate){ // Calculate minute Out Date
    $inDateMinute = $inDate->format('i');
    $outDateMinute = $outDate->format('i');

    $duration = $inDate->diff($outDate);
        $minutesTaken = $duration->i;

        switch(true) {
            case ($inDateMinute == $outDateMinute):
                $minutes = $minutesTaken;
                break;
                
            case ($inDateMinute != $outDateMinute):
                $minutes = 60 - $minutesTaken;
                break;
        }        

        return $minutes;
}

function calculateTotalHours($dateArray, $outDateString){ // Calculate total hour duration
    $startDate = new DateTime($dateArray[0]);
        $endDate = new DateTime($outDateString);

        // Calculate the difference between the dates
        $interval = $startDate->diff($endDate);

        // Get the total number of hours
        $totalHours = $interval->days * 24 + $interval->h;
        
        return $totalHours;
}
?>