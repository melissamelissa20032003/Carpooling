<?php

/** @var yii\web\View $this */

use yii\helpers\Html;

$this->title = 'About CeriCar';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about">
    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        CeriCar is a leading platform for carpooling, connecting drivers with passengers who need to travel in the same direction. Founded with the idea of offering an alternative to traditional transportation methods, CeriCar allows users to save money, reduce their carbon footprint, and meet new people along the way.
    </p>

    <h3>Our Mission</h3>
    <p>
        At CeriCar, our mission is simple: to make travel more affordable and environmentally friendly while fostering a sense of community. We believe that carpooling is not just a convenient mode of transport; it's a way to reduce road congestion, lower emissions, and connect people across distances.
    </p>

    <h3>How It Works</h3>
    <p>
        CeriCar makes it easy for drivers to share their journeys and for passengers to find rides. Whether you're going to a nearby town or across the country, CeriCar connects you with fellow travelers who share your route. Here's how it works:
    </p>
    <ul>
        <li><strong>Drivers</strong> can offer rides for available seats in their cars and set their own price per passenger.</li>
        <li><strong>Passengers</strong> can search for rides based on their desired destination, and book a seat in the car at a competitive price.</li>
        <li>Our platform makes it easy to communicate with your ride-share companions, ensuring a smooth and pleasant trip.</li>
    </ul>

    <h3>Why Choose Car?</h3>
    <ul>
        <li><strong>Cost-effective</strong>: Share the costs of your trip and save money on transportation.</li>
        <li><strong>Eco-friendly</strong>: Reduce your carbon footprint by carpooling with others.</li>
        <li><strong>Community</strong>: Meet new people and make friends while traveling.</li>
        <li><strong>Convenience</strong>: Easily find rides or passengers that match your schedule.</li>
    </ul>

    <h3>Join Us</h3>
    <p>
        Whether you're a driver looking to share your trip or a passenger seeking an affordable ride, CeriCar has a place for you. Sign up today and start connecting with fellow travelers!
    </p>

    <p>
        Thank you for choosing CeriCar – the smarter way to travel.
    </p>
</div>

<style>
.site-about {
    background-color: #f4f7fa;
    padding: 50px 20px;
    color: #333;
    font-family: 'Arial', sans-serif;
}

.site-about h1 {
    font-size: 2.5em;
    color: #333;
    margin-bottom: 20px;
}

.site-about h3 {
    font-size: 1.8em;
    color: #007bff;
    margin-top: 30px;
}M

.site-about p, .site-about ul {
    font-size: 1.1em;
    line-height: 1.6;
    margin-bottom: 20px;
}

ul {
    list-style-type: square;
    margin-left: 20px;
}


/* Sur les écrans larges (PC, tablettes) */
@media (min-width: 768px) {
    .header {
        font-size: 24px;
    }
}

/* Sur les petits écrans (smartphones) */
@media (max-width: 767px) {
    .header {
        font-size: 18px;
    }
}

</style>