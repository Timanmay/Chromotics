<?php

foreach (Question::findAll() as $question) {
    $question->display();
    echo "<br>";
}

