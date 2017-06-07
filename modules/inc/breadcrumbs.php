
<?php 

if ( is_menu_set('product-page') != ""){
    $url_link = "?product-page";
    $url_name = "Book Details";
}

else if ( is_menu_set('quick-view') != ""){
    $url_link = "?publisher_books";
    $url_name = "Book Summary Details";
}

else if ( is_menu_set('category-browse') != ""){
    $url_link = "?publisher_books";
    $url_name = "Category Books";
}

else if ( is_menu_set('ecd_books') != ""){
    $url_link = "?ecd_books";
    $url_name = "ECD Books";
}

else if ( is_menu_set('primary_books') != ""){
    $url_link = "?primary_books";
    $url_name = "Primary Books";
}

else if ( is_menu_set('secondary_books') != ""){
    $url_link = "?secondary_books";
    $url_name = "Secondary Books";
}

else if ( is_menu_set('adult_books') != ""){
    $url_link = "?adult_books";
    $url_name = "Adult Books";
}

else if ( is_menu_set('english_books') != ""){
    $url_link = "?english_books";
    $url_name = "English Books";
}

else if ( is_menu_set('kiswahili_books') != ""){
    $url_link = "?kiswahili_books";
    $url_name = "Kiswahili Books";
}

else if ( is_menu_set('activity_books') != ""){
    $url_link = "?activity_books";
    $url_name = "Activity Books";
}

else if ( is_menu_set('featured_books') != ""){
    $url_link = "?featured_books";
    $url_name = "Featured Books";
}

else if ( is_menu_set('class_one_books') != ""){
    $url_link = "?class_one_books";
    $url_name = "Class One Books";
}

else if ( is_menu_set('class_two_books') != ""){
    $url_link = "?class_two_books";
    $url_name = "Class Two Books";
}

else if ( is_menu_set('class_three_books') != ""){
    $url_link = "?class_three_books";
    $url_name = "Class Three Books";
}

else if ( is_menu_set('class_four_books') != ""){
    $url_link = "?class_four_books";
    $url_name = "Class Four Books";
}

else if ( is_menu_set('class_five_books') != ""){
    $url_link = "?class_five_books";
    $url_name = "Class Five Books";
}

else if ( is_menu_set('class_six_books') != ""){
    $url_link = "?class_six_books";
    $url_name = "Class Six Books";
}

else if ( is_menu_set('class_seven_books') != ""){
    $url_link = "?class_seven_books";
    $url_name = "Class Seven Books";
}

else if ( is_menu_set('class_eight_books') != ""){
    $url_link = "?class_eight_books";
    $url_name = "Class Eight Books";
}

else if ( is_menu_set('form_one_books') != ""){
    $url_link = "?form_one_books";
    $url_name = "Form One Books";
}

else if ( is_menu_set('form_two_books') != ""){
    $url_link = "?form_two_books";
    $url_name = "Form Two Books";
}

else if ( is_menu_set('form_three_books') != ""){
    $url_link = "?form_three_books";
    $url_name = "Form Three Books";
}

else if ( is_menu_set('form_four_books') != ""){
    $url_link = "?form_four_books";
    $url_name = "Form Four Books";
}

else if ( is_menu_set('publisher_books') != ""){
    $url_link = "?publisher_books";
    $url_name = "Publisher Books";
}

?>


<div class="bread-crumb radius">
    <a href="?home" title="Go to Home" class="tip-bottom">Home</a> <a href="<?php echo $url_link; ?>" class="current"><?php echo $url_name; ?></a> </div>  
</div>