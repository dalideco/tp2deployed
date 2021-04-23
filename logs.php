<?php
    include_once 'fragments/header.php';
    // $fp=fopen('data.txt','r');


    // $filename = 'info.txt';
    // $contents = file($filename);

    // foreach($contents as $line) {
    //     echo $line . "\n";
    // } 
 ?>

<div>
    <p>hello</p>
    <table class="table table-striped table-Info Info">
        <thead>
            <th>
                Date
            </th>
            <th>
                Done by 
            </th>
            <th>
                Description
            </th>
        </thead>
        <tbody>
            <?php 
                $filename = 'data.txt';
                $contents = file($filename);
                
                foreach($contents as $line) {
                    $tab = explode('--',$line);
            ?>
            <tr>
            <?php
                    foreach($tab as $element){
            ?>
                    <td>
                        <?= $element ?>
                    </td>
            <?php }} ?>
            </tr>
        </tbody>
    </table>
    
</div>