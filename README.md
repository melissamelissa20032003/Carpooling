# Carpooling
CERICar Application (Inspired by BlaBlaCar)
This project is a web-based carpooling platform inspired by BlaBlaCar, allowing users to propose and reserve rides, manage their profiles, and interact with other users.

Features
User Authentication: Users can register, log in, and manage their profiles.
Search Functionality: Users can search for available rides between different cities.
Ride Reservation: Users can reserve available seats in a carpool and view details about the ride.
Ride Proposals: Users can propose their own rides, subject to completing their profile (e.g., specifying their driver's permit).
Profile Management: Users can update their personal information, including their driver's permit number.
Ride Management: Users can view, edit, or delete the rides they’ve proposed.
Project Structure
This project uses the Yii framework. Here is an overview of the key components:

Controllers:
SiteController: Handles user interactions such as login, profile management, ride search, reservation, and proposing a new ride.
actionRecherche: Handles ride search, either returning the results directly or via an AJAX request.
actionReserve: Handles the reservation process, ensuring there are enough available seats.
actionProposer: Allows logged-in users to propose a new ride, with checks for valid driver permit information.
actionProfile: Displays the user's profile and their reservations.
actionVoirVoyage: Displays details of a ride (e.g., proposed by the user or available for reservation).
actionSupprimerVoyage: Deletes a proposed ride from the database.
VoyageController: Manages ride-related actions.
Key Models
Internaute (User): Represents users of the system. The model implements the IdentityInterface for Yii authentication.

The getUsername function is used to return the username (pseudo) of the user.
Permissions: Before proposing a ride, users must enter their driver's permit number in their profile.
Voyage (Ride): Represents a proposed ride in the system. This includes information such as the departure city, arrival city, vehicle type, available seats, and travel time.

Relationships:
A ride has many reservations.
A ride has a driver (internaut) connected via the conducteur field.
Reservation: Represents a reservation made by a passenger for a ride. Each reservation is linked to a user and a ride.

Trajet (Route): Represents the routes between cities. Each ride is linked to a specific route.

ReservationForm & VoyageForm: These are the forms that handle user input for ride reservations and ride proposals.

Features Implementation
User Authentication & Profile Management
Login: Users authenticate using their username (pseudo) and password.
Profile: Users can view and update their profiles, including their driver's permit number.
Permit Check: Users are required to provide their driver's permit number before they can propose a new ride.
Ride Search
Search: Users can search for available rides between two cities. The system retrieves the rides based on the selected departure and arrival cities, and displays them in a table format.
AJAX Results: The search results are dynamically loaded using AJAX for a smoother user experience.
Ride Reservation
Reserving a Seat: Users can reserve seats for a ride. The system checks if enough seats are available before allowing the reservation.
Redirect to Profile: After a reservation is made, the user is redirected to their profile where they can view their reservations.
Ride Proposals
Propose a Ride: Users can propose a new ride, specifying details like departure city, arrival city, available seats, travel time, and constraints.
Driver's Permit Check: A driver must have their permit entered in their profile before they can propose a ride.
Ride Deletion: Users can delete a proposed ride from their profile, and it will be removed from the database.
Features Breakdown
User Flow:

Sign Up / Login: Users can create accounts or log in with their credentials. Logged-in users can propose rides and make reservations.
Profile: Users can view and update their profile information, including their driver's permit number.
Search & Reserve: Users can search for available rides based on their destination cities and make reservations for available seats.
Propose a Ride: Logged-in users can propose a ride by entering the necessary trip details. The system checks if the driver's permit is provided.
Ride Search & Booking:

Users can search for rides between cities. Once the search results are displayed, users can reserve available seats in the cars.
The number of available seats is updated after each reservation.
Admin-Only Features:

Admin users can view all rides, passengers, and reservations. They can manage the database content, if necessary.
How to Set Up
Clone the Repository:

Clone the project to your local machine using git clone.
Set Up the Database:

Make sure you have a MySQL database ready.
Import the SQL schema to set up the necessary tables.
Update Configuration:

Update the database connection settings in config/db.php.
Make sure the correct database credentials and table prefixes are configured.
Run the Application:

Use the Yii framework's built-in server to run the application: php yii serve.
Additional Features
Validation: All input fields, such as user credentials, permit number, and ride details, have validation rules to ensure correct and complete data entry.
Responsive Design: The application is designed to be mobile-friendly, adapting to different screen sizes for a better user experience on mobile devices.
Conclusion
This project is a simple carpooling platform that allows users to offer and book rides. It uses Yii framework and provides essential functionalities like user authentication, ride search, booking, profile management, and ride proposal with a clean and responsive user interface.
