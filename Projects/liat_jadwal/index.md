<html>
<head>
  <style>
    body{
    background-color: black;
    color: white;
    }

  </style>
</head>
<body>
 <div markdown="1">
# **liat_jadwal.py**

Here is the full code.

![](sc_liat_kelas.png)

I use 4 modules.
Requests module for http request.
Json module to process json data.
Sys module for exiting the program.
Prettytable module to print out the output in a table.
The script logs in to a website for Binus students to see their class schedule.
After it logs in, it gets the schedule data from "/Home/GetViconSchedule" in json format, process it using the json module and prints the columns that is in the "att" variable which is the columns that I really need.
