<?php
include 'includes/config.php';
session_start();
$username=  $_SESSION['gwaliusername'];
Database::$conn= mysqli_connect("localhost", "root", "Gwalian4.");
mysqli_select_db( Database::$conn, "cbt");
$query = "SELECT * FROM users WHERE username= '$username' ";
        $result=mysqli_query(Database::$conn, $query);
        $row= mysqli_fetch_array($result);
        $resul= $row['chemanswers'];
        $bioscore= $row['bioanswers'];
        $engscore= $row['enganswers'];
        $physcore= $row['phyanswers'];
$chemAns='[
    {"answer":"0","option":""},{"answer":"In true solutions, the solutes can be seen","option":"a"},{"answer":"Nitrogen.","option":"a"},{"answer":"dehydrogenase","option":"d"},{"answer":"C<sub>6</sub>H<sub>12</sub>O<sub>6</sub>","option":"d"},{"answer":"hydrolysis","option":"c"},{"answer":"tertiary alkanol","option":"c"},{"answer":"ethene","option":"b"},{"answer":"form complex ions","option":"b"},{"answer":"Au","option":"d"},{"answer":"hex-3-ene","option":"a"},{"answer":"fehlings solution","option":"d"},{"answer":"Lithium","option":"d"},{"answer":"Hydrogen","option":"b"},{"answer":"An increase in concentration of reactants shifts equilibrum forward","option":"a"},{"answer":"21%","option":"c"},{"answer":"15.0 atm","option":"b"},{"answer":"ionic bonding","option":"a"},{"answer":"sublimation","option":"b"},{"answer":"25","option":"b"},{"answer":"Q will form an electrovalent bond with S","option":"d"}
]';
$bioAns='[
    {"answer":"0","option":""},{"answer":"Proteins","option":"d"},{"answer":"liver","option":"d"},{"answer":"transpires","option":"c"},{"answer":"holophytically","option":"d"},{"answer":"mitochondria","option":"c"},{"answer":"Carbon dioxide and alcohol","option":"c"},{"answer":"uriniferous tubules","option":"a"},{"answer":"locomotion","option":"b"},{"answer":"Exoskeleton","option":"b"},{"answer":"absence of large vacuoles","option":"c"},{"answer":"insects","option":"c"},{"answer":"helps in softening","option":"b"},{"answer":"spore","option":"a"},{"answer":"amphibian","option":"a"},{"answer":"sperm cell","option":"c"},{"answer":"phalanges","option":"c"},{"answer":"cytoplasmic membrane","option":"b"},{"answer":"Thymine","option":"d"},{"answer":"cytokinesis","option":"d"},{"answer":"deserts","option":"d"}]';
$phyAns='[{"answer":"0", "option":""},{"answer":"is dependent on the shape and volume of the container","option":"d"},{"answer":"1.0 J","option":"d"},{"answer":"moon","option":"c"},{"answer":"Driving mirror","option":"d"},{"answer":"25oC","option":"a"},{"answer":"4.8 km","option":"c"},{"answer":"Contraction of water when it is heated between 0oC and 4oC","option":"c"},{"answer":"Inelastic collision, both linear momentum and kinetic energy are conserved","option":"a"},{"answer":"sand","option":"d"},{"answer":"Malaopia","option":"d"},{"answer":"5.71kJ","option":"d"},{"answer":"None of the above","option":"d"},{"answer":"(i) (ii) (iii) (iv) (v)","option":"d"},{"answer":"The weight of an object varies from one place to another","option":"c"},{"answer":"1.2 Joule","option":"d"},{"answer":"Its image is real and inverted","option":"a"},{"answer":"retina","option":"a"},{"answer":"Cornea","option":"a"},{"answer":"0.2 dioptres","option":"b"},{"answer":"Image formed is virtual and upright","option":"c"}]';
$engAns='[{"answer":"0", "option":""},{"answer":"gerund","option":"c"},{"answer":"participial phrase","option":"c"},{"answer":"conditional clause","option":"c"},{"answer":"Jargon","option":"a"},{"answer":"abhorrence","option":"a"},{"answer":"businesses","option":"a"},{"answer":"snubbed","option":"c"},{"answer":"too","option":"b"},{"answer":"quay","option":"b"},{"answer":"accommodation","option":"b"},{"answer":"adverbial clause of time","option":"d"},{"answer":"appositive phrase","option":"c"},{"answer":"subordinating conjunction","option":"d"},{"answer":"a finite verb","option":"c"},{"answer":"thoughtful statement","option":"a"},{"answer":"verb","option":"b"},{"answer":"participial clause","option":"c"},{"answer":"thug","option":"b"},{"answer":"afterNOON","option":"b"},{"answer":"commiTEE","option":"c"}]';
$chemanswer = json_decode($chemAns,true);
$enganswer = json_decode($engAns,true);
$bioanswer = json_decode($bioAns,true);
$phyanswer = json_decode($phyAns,true);
$chemscore = json_decode($resul,true);
$bioscore= json_decode($bioscore,true);
$engscore= json_decode($engscore,true);
$physcore= json_decode($physcore,true);
$count=0;
$count1=0;
$count2=0;
$count3=0;
//echo $answer[0]['answer'];
for($x=1;$x<21;$x++){
    if($chemanswer[$x]['option']==$chemscore[$x]['option']){
        $count++;
    }
}
for($x=1;$x<21;$x++){
    if($enganswer[$x]['option']==$engscore[$x]['option']){
        $count2++;
    }
}
for($x=1;$x<21;$x++){
    if($bioanswer[$x]['option']==$bioscore[$x]['option']){
        $count3++;
    }
}
for($x=1;$x<21;$x++){
    if($phyanswer[$x]['option']==$physcore[$x]['option']){
        $count1++;
    }
}
     $score= (($count/20)*100) + (($count1/20)*100) + (($count2/20)*100) + (($count3/20)*100);?>
     <html>
     <head>
     <link type="text/css" rel="stylesheet" href="tryme.css">
            <meta charset="utf-8">
            <meta content="width=device-width,height=device-height initial-scale=1.0">
            <title> Here is your result</title>
     </head>
     <table style="width:900px; height:500px">
     <caption> <strong id="name"><?php echo $_SESSION['gwaliusername']."'s result"?></strong></caption>
     <th>Subject</th><th>Score</th><th>Percentage</th>
     <tr><td>Biology</td><td><?php echo $count3 ?>/20</td><td><?php echo (($count3/20)*100)."%"?></td>
     </tr>
     <tr><td>Chemistry</td><td><?php echo $count ?>/20</td><td><?php echo (($count/20)*100)."%"?></td>
     </tr>
     <tr><td>English</td><td><?php echo $count2 ?>/20</td><td><?php echo (($count2/20)*100)."%"?></td>
     </tr>
     <tr><td>Physics</td><td><?php echo $count1 ?>/20</td><td><?php echo (($count1/20)*100)."%"?></td>
     </tr>
     </table>

     <h3> Your total score is <?php echo $score ?>/400</h3>
</html>