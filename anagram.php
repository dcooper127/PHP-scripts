<html>
  <head>
    <style>
      div.myText{max-width:40%;}
      body{background-color: #ddf8ff;}
    </style>

    <title> PHP Anagram Webpage </title>
  </head>

   <body>

     <center> <h1> David Cooper's Webpage for PHP Anagram Solutions </h1> </center>

     <hr>

    <div class ="myText">
       <p>
         Welcome Carahsoft Representatives! <br><br> I saw that this position involved a lot of PHP, which is a skill I hadn't yet learned at the time of applying.
         Out of a desire to show that I'm willing to do whatever it takes for this position, and as a demonstration of how fast I can learn any skills needed,
         I have been learning how to write PHP code, and made this HTML webpage with an embedded PHP script to solve the anagram programming excercise.
       </p>

       <h2>Instructions</h2>

       <p>
         Enter one word into the textbox for "Word 1" and the second into the textbox for "Word 2" and click "Submit" to see if the words are anagrams of each other (not case sensitive.)
       </p>

    </div>

    <hr>


      <form action = "<?php $_PHP_SELF ?>" method = "POST">
         Word 1: <input type = "text" name = "w1" />
         Word 2: <input type = "text" name = "w2" />
         <input type = "submit" />
      </form>

      <?php

        //A PHP function congruent to my naive Java anagram solution.
        //
        //In case were starting here: the strategy is to make sure all
        //the characters in each word are lower case, sort them,
        //then see if the two sorted words are the same.
        //Why this is naive: Its an easy solution but its at the mercy of the runtime of the sort.
        function isAnagramNaive($w1, $w2)
        {
             //Lets start by converting both words to all lower case letters
             $w1Lower = strtolower($w1);
             $w2Lower = strtolower($w2);

             //Need to split the string into an array of chars so we can sort them
             $w1Split = str_split($w1Lower);
             $w2Split = str_split($w2Lower);

             //Here we sort the split words
             sort($w1Split);
             sort($w2Split);

             //We can use the === operator to make sure all the elements of each array are of the same type and in the same order.
             //Alternatively we can implode() the char arrays back together and compare them but this saves a step.
             return ($w1Split === $w2Split);



        }

        //Says its using a Hash but it really just takes advantage of PHPs Assiciative Arrays to
        //fufill a similar behavior.
        //
        //In case were starting here: the strategy is to take advantage of O(1) lookup instead of sorting for
        //an O(n) runtime.
        function isAnagramHash($w1, $w2)
        {
            //Lower case all the letters
            $w1Lower = strtolower($w1);
            $w2Lower = strtolower($w2);

            //Split into char arrays so we can use each char as the associated index in whats essentiallty our HashMap
            $w1Split = str_split($w1Lower);
            $w2Split = str_split($w2Lower);

            //Create our associatve array.
            $charArray = array();

            //use a foreach loop on the first array
            foreach ($w1Split as $char)
            {
              //if the char isn't present in the array yet, add it with a value of 1
              if(!array_key_exists($char,$charArray))
                $charArray[$char] = 1;

              //else increment its value by 1.
              else
                $charArray[$char] = $charArray[$char] + 1;
            }

            foreach ($w2Split as $char)
            {
              //if the char isn't present in the array yet, add it with a value of -1
              if(!array_key_exists($char,$charArray))
                $charArray[$char] = -1;

              //else, decrement its count
              else
                $charArray[$char] = $charArray[$char] - 1;
            }

            //Itterate through the char Array. If any values for a key are not 0, its not an anagram
            foreach($charArray as $key => $value)
            {
              if($value!=0)
                return false;

            }

            //If this code is reached then all values in the char array are 0, so return true.
            return true;

        }

        //function isAnagramHash($w1, $w2)

         if( @$_POST["w1"] && @$_POST["w2"] ) {


            $answerNaive = isAnagramNaive(@$_POST["w1"], @$_POST["w2"]);

            echo 'Naive Method Result: ' . @$_POST["w1"]. " and "  . @$_POST["w2"] . " are ";

            if($answerNaive)
              echo 'anagrams <br>';

            else
              echo 'not anagrams <br>';

            $answerHash = isAnagramHash(@$_POST["w1"], @$_POST["w2"]);

            echo 'Hash Method Result: ' . @$_POST["w1"]. " and "  . @$_POST["w2"] . " are ";

            if($answerHash)
              echo 'anagrams <br>';

            else
              echo 'not anagrams <br>';


            //exit();
         }
      ?>

   </body>
</html>
