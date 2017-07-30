 <ul id="nav">
                <li class="current"><a href="#">Home</a></li>
                <li><a href="#">File</a>
                    <ul>
                    
                    	<?php
						if (isset($_SESSION['appId']))
						{ ?>
                        <li><a href="closeproject.php">Close <?php echo $_SESSION['projectname'] ?></a></li>
                        <?php } else { ?>
                        <li><a href="newproject.php">New Project</a></li>
                        <?php } ?>
                        <li><a href="loadproject.php">Load Project</a></li>
                        <li><a href="connect.php">Database</a></li>
                        <li><a href="rad.php?db=$db&do=generate">Generate Code</a></li>
                        <li><a href="logout.php">Logout</a></li>
                    </ul>
                </li>
                <li><a href="#">About</a></li>
                <li><a href="#">Contact Us</a></li>
                <?php
				if (isset($_SESSION['appId']))
						{ ?>
                        <li><a href=#>Project <?php echo $_SESSION['projectname'] ?> Loaded</a></li>
                        <?php } ?>
			
            </ul>