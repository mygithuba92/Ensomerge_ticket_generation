<?php
  include 'header.php';

  
  
  
  
  
?>

<html>
	<head>
		<title>Client Details</title>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="modal.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="dist/css/adminlte.min.css">
  <!-- Google Font: Source Sans Pro -->
  <!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css"> -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
		<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.2.0/jquery.min.js"></script>
		<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" /> -->
		<!-- <script src="https://cdn.datatables.net/1.10.12/js/jquery.dataTables.min.js"></script> -->
		<!-- <script src="https://cdn.datatables.net/1.10.12/js/dataTables.bootstrap.min.js"></script>		 -->
		<!-- <link rel="stylesheet" href="https://cdn.datatables.net/1.10.12/css/dataTables.bootstrap.min.css" /> -->
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/js/bootstrap.min.js"></script>

	</head>
	<body>
		<!-- Content Wrapper. Contains page content -->
		<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <section class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1>All Tickets</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item ">All Tickets</li>
            </ol>
          </div>
         
        </div>
      </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        
          <!-- /.col -->
        
        <!-- /.row -->
        
        <!-- /.row -->
        <div class="row">
          <div class="col-12">
            <div class="card" style="height: 460px;">
              
              <!-- /.card-header -->
        <div class="card-body table-responsive p-0" style="height: 460px;">
				
			  <table class="table table-head-fixed text-nowrap" id="user_data">
					<thead>
						<tr>
                            <th>Ticket no</th>
                            <th style="padding: 6px 0px 10px 24px;">Client name</th>
                            <th>Request status</th>
                            <th>Discipline</th>
                            <th>Request type</th>
                            <th>Ticket status</th>
                            <th>AU offshore owner</th>
                            <th>Request update</th>
						</tr>
					</thead>
					
					<?php
						$servername = "10.128.0.9";
						$username = "rajni";
						$password = "rajni136@@";
						$dbname = "ticket";

						// Create connection
						$conn = new mysqli($servername, $username, $password, $dbname);

						// Check connection
						if ($conn->connect_error) {
    						die("Connection failed: " . $conn->connect_error);
						}
						// echo "Connected successfully";
						 $sql="SELECT a.`ticket_no`,a.`client_name`,a.`request_status`,a.`discipline`,a.`request_type`,b.`status`,a.`au_officer`,a.`request_update` FROM details a,updates b WHERE b.`id` IN (SELECT MAX(b.`id`) FROM updates b GROUP BY ticket_no) AND a.`ticket_no`=b.`ticket_no`  ";
						$result = $conn->query($sql);

						if ($result->num_rows > 0) {
    					// output data of each row
    					while($row = $result->fetch_assoc()) {
                            $ticket_no=$row['ticket_no'];
					?> 
					<tr>
                        <td><?php echo "<a href='view.php?id=$ticket_no'>".$ticket_no."</a>" ; ?></td>
                        <td><button id="myBtnx" name="<?php echo $row['client_name'];?>" class="btn" data-modal="myModalx"><?php echo $row['client_name'];?></button></td>
                        <td><?php echo $row['request_status']; ?></td>
                            <?php
                           if ($row['discipline'] == 1) {
                          echo "<td>"."Human Resource"."</td>";
                        }

                         else if ($row['discipline'] == 2) {
                          echo "<td>"."Finance"."</td>";
                        }

                        else if ($row['discipline'] == 3) {
                          echo "<td>"."Operation team"."</td>";
                        }
                        else
                          {
                            echo "<td>"."IT"."</td>";
                          }

            ?>
                        <td><?php echo $row['request_type']; ?></td>
                           <?php
                           if ($row['status'] == 'Candidate On Board' || $row['status'] == 'Sourcing in Process' || $row['status'] == 'On Going') {
                         echo "<td> <span class='badge badge-warning'>".$row['status']."</span></td>";
                        }

                         else if ($row['status'] == 'Offer Letter Rolled out' or $row['status'] == 'Candidates Acceptance' or $row['status'] == 'Candidates Rejection' or $row['status'] == 'Lost the Deal' or $row['status'] == 'Resolved - Ticket Closed' or $row['status'] == 'Cannot be Worked - Ticket Closed' or $row['status'] == 'EM Reject - Not Feasible' or $row['status'] == 'Not Applicable' ) {
                           echo "<td> <span class='badge badge-success'>".$row['status']."</span></td>";
                        }
                        else
                        {
                           echo "<td> <span class='badge badge-info'>".$row['status']."</span></td>";
                        }
                        
                      

            ?>
                        <td><?php echo $row['au_officer']; ?></td>
                        <td><?php echo $row['request_update']; ?></td> 
					</tr>	
					<?php
						}
						}
					?>

				</table>
				</div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
        </div>
</div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->





  
	</body>
</html>
<?php
	include 'footer.php';
?>


<!-- The Modal -->
<div id="myModalx" class="modalx">

  <!-- Modal content -->
  <div class="modalx-content">
    <div class="modalx-header">
    <span class="closex">&times;</span>
        <h3 id="modalx-text" class="y"></h3>
      
      
    </div>
    <div class="modalx-body">
        <table width="100%">
            <tr> 
                <td width="50%">
                    <label>GST Registration Type:</label><br>
                    <div id="GST" class="x"></div>
                </td>
                <td>
                    <label>GSTIN:</label><br>
                    <div id="GSTIN" class="x"></div>
                </td>
                <tr>
                    <td colspan="2">
                        <label>Street Address:</label><br>
                        <div id="address" class="x"></div>
                    </td>
                </tr>
                <tr>
                    <td class="bor">
                        <label>Phone:</label><br>
                        <div id="phones" class="x"></div>
                    </td>
                    <td style="border-bottom: none;">
                        <label>Email:</label><br>
                        <div id="emails" class="x"></div>
                    </td>
                </tr>
            </tr>
        </table>
    </div>
    <div class="modalx-footer">
      
    </div>
  </div>

</div>

<script type="text/javascript" language="javascript" src="modal.js">
      
</script>







