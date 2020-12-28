<?php
session_start();
?>
<header class="header1">
        <!-- Header desktop -->
        <div class="container-menu-header">
            <div class="topbar">
                <span class="topbar-child1">
                    Ho Chi Minh University of Technology
                </span>
            </div>

            <div class="wrap_header">                
                <!-- Menu -->
                <div class="wrap_menu">
                    <nav class="menu">
                        <ul class="main_menu">
                            <!-- <li>
                                <a href="home.html">Trang chủ</a>
                            </li> -->

                            <li>
                                <a href="book.php">Thư viện</a>
                            </li>
                            <?php 

                                if (isset($_SESSION["isloggin"]) == false){}
                                else{
                                    if ($_SESSION["role"] == 4){
                                        ?>
                                        <li>
                                            <a href="management.php">Quản lý</a>
                                        </li>
                                        <?php
                                    }
                                }
                            ?>
                            
                            <!-- <li>
                                <a href="contact.php">Liên lạc</a>
                            </li> -->
                        </ul>
                    </nav>
                </div>

				<!-- Header Icon -->
				<div class="header-icons">
                    <?php
                        if (isset($_SESSION["isloggin"]) == false){
                    ?>
					<li>
						<a href="index.php">Đăng nhập</a>
					</li>
                    <?php
                        }
                        else{
                            ?>
                            <li>
                            <a href="logout.php">Đăng xuất</a>
                            </li>
                            <?php
                        }
                    ?>
					<span class="linedivide1"></span>

					<!-- <a href="manageaccount.php" class="header-wrapicon1 dis-block">
						<img src="images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
					</a>

					<span class="linedivide1"></span>	 -->
                    <?php
                    if (isset($_SESSION["isloggin"]) == false){}
                    else{
                            ?>
                            <a href="manageaccount.php"><?php echo $_SESSION["name"] ?></a>
                            <?php
                    }
                    ?>
				</div>
               
            </div>
        </div>

        <!-- Header Mobile -->
        <div class="wrap_header_mobile">
            <!-- Logo moblie -->
            <a href="index.php" class="logo-mobile">
                <img src="images/icons/express.png" alt="IMG-LOGO">
            </a>

            <!-- Button show menu -->
            <div class="btn-show-menu">
                <!-- Header Icon mobile -->
                <div class="header-icons-mobile">
                    <a href="manageaccount.php" class="header-wrapicon1 dis-block">
                        <img src="images/icons/icon-header-01.png" class="header-icon1" alt="ICON">
                    </a>

                    <span class="linedivide2"></span>

                    <div class="header-wrapicon2">
                        <img src="images/icons/icon-header-02.png" class="header-icon1 js-show-header-dropdown" alt="ICON">
                        <span class="header-icons-noti">0</span>

                        <!-- Header cart noti -->
                        
                    </div>
                </div>

                
            </div>
        </div>

        <!-- Menu Mobile -->
        <div class="wrap-side-menu" >
            <nav class="side-menu">
                <ul class="main-menu">
                    <li class="item-topbar-mobile p-l-20 p-t-8 p-b-8">
                        <span class="topbar-child1">
                            Ho Chi Minh University of Technology
                        </span>
                    </li>
                    
                    <!-- <li class="item-menu-mobile">
                        <a href="home.html">Trang chủ</a>
                        
                    </li> -->

                    <li class="item-menu-mobile">
                        <a href="product.php">Thư viện</a>
                    </li>
                    <?php 

                                if (isset($_SESSION["isloggin"]) == false){}
                                else{
                                    if ($_SESSION["role"] == 4){
                                        ?>
                                        <li>
                                            <a href="management.php">Quản lý</a>
                                        </li>
                                        <?php
                                    }
                                }
                            ?>
                    <!-- <li class="item-menu-mobile">
                        <a href="contact.php">Liên lạc</a>
                    </li> -->
                </ul>
            </nav>
        </div>
    </header>
