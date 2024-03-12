<h2>Steps to install:</h2>
<br>
<ul>
    <li><p>Clone the repository to you local machine.</p></li>
    <il><p>Open command prompt and navigate to the project folder.</p></li>
    <li>
        <p>If you have <b>composer</b> installed on your computer, run the command below on the command prompt.</p>
        <b>composer install</b>
        <p>if not, please install it first</p>
    </li>
    <li>
        <p>If you have XAMPP installed on your computer, start the Apache and MySQL services</p>
        <p>if not, please install it first</p>
    </li>
    <li><p>Open <b>http://localhost/phpmyadmin/</b> and create a database named <b>outsourced_exam</b></p></li>
    <li><p>edit the .env file on your project folder and change the value for <b>DB_DATABASE</b> to <b>outsourced_exam</b></p></li>
    <li>
        <p>Run the ff. commands on the command prompt</p>
        <p><b>php artisan migrate</b></p>
        <p><b>php artisan db:seed --class=LibrarySeeder</b></p>
    </li>
</ul>
<p>Please install Postman on your machine for testing the api</p>
<p>I prepared the list of possible requests for this project</p>
<p>Download the Collection <a href="https://drive.google.com/file/d/1kYUQFFYi_IDo2vFgtqYh5p3-5WOBTuw-/view?usp=drive_link">here</a></p>