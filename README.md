# Upgradation-Module
### Objective
Deployed to automate the process of allocating vacant seats to students interested in upgrading their academic branches after the completion of their first year in college.

### Functionality
Accepts the following information from students who wish to upgrade from their current academic streams :
<ul>
  <li>Name</li>
  <li>College Roll Number</li>
  <li>Current Branch</li>
  <li>CPI</li>
  <li>Branch Upgrade Preferences</li>
</ul>

After gathering the data from each interested student, the admin inputs the available seats in each branch following which an algorithm is run which compares the student requests to the vacant seats. It then proceeds to grant requests to the students based on their ranks, preferences and the availability.

### Installation and Set-up
<ol>
  <li><a href = 'https://www.apachefriends.org/download.html'>Install Xampp</a></li>
  <li>Open the <b>Control Panel / Manager</b> from the downloaded Xampp file.</li>
  <li>Start the MySQL database and Apache Server.</li>
  <li>Open the <b>htdocs</b> folder in the Xampp file and clone <a href='https://github.com/pavleenkaur/Upgradation-Module/'>this </a>repository</li>
</ol>

### Usage
<ol>
  <li>Run the <b>database.php</b> file to create the requisite tables on the server.</li>  
  <li>Can be interchanged with Step 3. Go to <b>index.php</b>. Login onto the admin profile and submit the number of available seats in each branch<br>Default Admin
    Login Credentials :
    <table>
      <tr>
        <td>Username</td>
        <td>Password</td>
      </tr>
      <tr>
        <td>admin@gmail.com</td>
        <td>admin</td>
      </tr>
    </table>
    The information will be saved in the <b>seatsDetails</b> table.
  </li>
  <li><b>register.php</b> handles the student information registrations.</li>  
  <li>After all the students have registered, login back to the admin profile and click on <b>Compute Upgrade Details</b> which runs the algorithm.</li>  
  <li>Finally click on <b>View Upgrade Details</b> to see the new allocated branches.</li>  
</ol>
