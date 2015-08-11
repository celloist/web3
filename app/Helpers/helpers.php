<?php
function product_images_path () {
	return public_path() . relative_images_path();
}

function relative_images_path () {
	return '/images/products/';	
}