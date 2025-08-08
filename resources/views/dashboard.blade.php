<x-layout>
    <body class="bg-gray-50" style="position: relative; width: 1280px; height: 800px; background: #FFFFFF; overflow: hidden;">
        <div class="flex min-h-screen">
            <!-- Sidebar -->
            <aside style="position: absolute; width: 240px; height: 800px; left: 0px; top: 0px; background: #FFFFFF; border: 1px solid #E5E5E5;">
                <!-- Logo Section --->
                <div class="flex justify-end items-center p-6 border-b border-gray-100" style="height: 120px; padding-top: 20px; padding-left: 20px;">
                    <img src="/logo/logo-teal.png" alt="Logo" style="height: 40px; margin-right: 10px;">
                </div>

                <!-- Navigation Menu -->
                <nav class="flex-1 px-4 py-4 overflow-y-auto">
                    <ul style="margin-top: 20px;">
                        <!-- General -->
                        <li style="list-style-type: none; margin-bottom: 16px;">
                            <a href="#" style="position: absolute; width: 220px; height: 60px; left: 10px; top: 140px; background: #F0F0F0; border-radius: 5px; display: flex; align-items: center;">
                                <div style="position: absolute; width: 24px; height: 24px; left: 32px; top: 18px; display: flex; align-items: center; justify-content: center;">
                                    <i class="ri-dashboard-line text-gray-600 text-lg"></i>
                                </div>
                                <span style="position: absolute; left: 69px; font-family: 'Raleway'; font-weight: 400; font-size: 14px; line-height: 14px; color: #000000;">General</span>
                            </a>
                        </li>
                        
                        <!-- Statistics -->
                        <li style="list-style-type: none; margin-bottom: 16px;">
                            <a href="#" style="position: absolute; width: 220px; height: 60px; left: 10px; top: 210px; background: #FFFFFF; border-radius: 5px; display: flex; align-items: center;">
                                <div style="position: absolute; width: 24px; height: 24px; left: 32px; top: 18px; display: flex; align-items: center; justify-content: center;">
                                    <i class="ri-bar-chart-line text-gray-600 text-lg"></i>
                                </div>
                                <span style="position: absolute; left: 69px; font-family: 'Raleway'; font-weight: 400; font-size: 14px; line-height: 14px; color: #000000;">Statistics</span>
                            </a>
                        </li>
                        
                        <!-- Waiting list -->
                        <li style="list-style-type: none; margin-bottom: 16px;">
                            <a href="#" style="position: absolute; width: 220px; height: 60px; left: 10px; top: 280px; background: #FFFFFF; border-radius: 5px; display: flex; align-items: center;">
                                <div style="position: absolute; width: 24px; height: 24px; left: 32px; top: 18px; display: flex; align-items: center; justify-content: center;">
                                    <i class="ri-list-check text-gray-600 text-lg"></i>
                                </div>
                                <span style="position: absolute; left: 69px; font-family: 'Raleway'; font-weight: 400; font-size: 14px; line-height: 14px; color: #000000;">Waiting list</span>
                            </a>
                        </li>
                        
                        <!-- Admins -->
                        <li style="list-style-type: none; margin-bottom: 16px;">
                            <a href="#" style="position: absolute; width: 220px; height: 60px; left: 10px; top: 350px; background: #FFFFFF; border-radius: 5px; display: flex; align-items: center;">
                                <div style="position: absolute; width: 24px; height: 24px; left: 32px; top: 18px; display: flex; align-items: center; justify-content: center;">
                                    <i class="ri-user-settings-line text-gray-600 text-lg"></i>
                                </div>
                                <span style="position: absolute; left: 69px; font-family: 'Raleway'; font-weight: 400; font-size: 14px; line-height: 14px; color: #000000;">Admins</span>
                            </a>
                        </li>
                        
                        <!-- Profile settings -->
                        <li style="list-style-type: none;">
                            <a href="#" style="position: absolute; width: 220px; height: 60px; left: 10px; top: 420px; background: #FFFFFF; border-radius: 5px; display: flex; align-items: center;">
                                <div style="position: absolute; width: 24px; height: 24px; left: 32px; top: 18px; display: flex; align-items: center; justify-content: center;">
                                    <i class="ri-settings-3-line text-gray-600 text-lg"></i>
                                </div>
                                <span style="position: absolute; left: 69px; font-family: 'Raleway'; font-weight: 400; font-size: 14px; line-height: 14px; color: #000000;">Profile settings</span>
                            </a>
                        </li>
                    </ul>
                </nav>

                <!-- User Profile --->
                <div style="position: absolute; width: 200px; height: 72px; left: 20px; top: 695px; background: #F0F0F0; border-radius: 5px;">
                    <div style="position: absolute; width: 40px; height: 40px; left: 16px; top: 16px; background: #10B982; border-radius: 20px;">
                        <span style="position: absolute; width: 10px; height: 19px; left: 15px; top: 10px; font-family: 'Raleway'; font-weight: 700; font-size: 16px; line-height: 19px; color: #FFFFFF;">S</span>
                    </div>
                    <div style="position: absolute; width: 75px; height: 16px; left: 66px; top: 15px; font-family: 'Raleway'; font-weight: 500; font-size: 14px; line-height: 16px; color: #000000;">Saron Yirga</div>
                    <div style="position: absolute; width: 84px; height: 14px; left: 66px; top: 35px; font-family: 'Raleway'; font-weight: 500; font-size: 12px; line-height: 14px; color: #000000;">saronyirga@g...</div>
                    <div style="position: absolute; width: 20px; height: 20px; left: 160px; top: 26px;">
                        <i class="ri-arrow-up-s-line" style="position: absolute; left: 0; top: 0; font-size: 20px; color: #505050;"></i>
                        <i class="ri-arrow-down-s-line" style="position: absolute; left: 0; top: 10px; font-size: 20px; color: #505050;"></i>
                    </div>
                </div>
            </aside>

            <!-- Main Content Area -->
            <div class="ml-64 flex-1" style="position: absolute; width: 1040px; height: 800px; left: 240px; top: 0px;">
                <main class="p-8" style="height: 100%;">
                    <!-- Stats Cards -->
                    <div class="grid grid-cols-3 gap-6 mb-8" style="position: absolute; width: 980px; height: 130px; left: 20px; top: 20px;">
                        <!-- Total Waiting List Card -->
                        <div class="bg-white rounded-xl shadow-sm p-6" style="position: absolute; width: 314px; height: 130px; left: 0px; top: 0px; background: #FFFFFF; border: 1px solid #E5E5E5; border-radius: 10px;">
                            <div class="flex justify-between">
                                <div class="flex flex-col items-end justify-center" style="height: 100%;">
                                    <p class="text-sm text-gray-500" style="font-family: 'Raleway'; font-weight: 500; font-size: 18px; line-height: 21px; color: #505050;">Total waiting list</p>
                                    <p class="text-xl font-bold" style="font-family: 'Raleway'; font-weight: 700; font-size: 32px; line-height: 38px; color: #000000;">43</p>
                                </div>
                                <div style="position: absolute; width: 65px; height: 65px; right: 20px; top: 32px; background: #10B982; opacity: 0.75; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                    <i class="ri-list-check text-white text-2xl"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Total Admins Card -->
                        <div class="bg-white rounded-xl shadow-sm p-6" style="position: absolute; width: 314px; height: 130px; left: 338px; top: 0px; background: #FFFFFF; border: 1px solid #E5E5E5; border-radius: 10px;">
                            <div class="flex justify-between">
                                <div>
                                    <p class="text-sm text-gray-500" style="font-family: 'Raleway'; font-weight: 500; font-size: 18px; line-height: 21px; color: #505050;">Total admins</p>
                                    <p class="text-xl font-bold" style="font-family: 'Raleway'; font-weight: 700; font-size: 32px; line-height: 38px; color: #000000;">6</p>
                                </div>
                                <div style="position: absolute; width: 65px; height: 65px; right: 20px; top: 32px; background: #10B982; opacity: 0.75; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                    <i class="ri-user-line text-white text-2xl"></i>
                                </div>
                            </div>
                        </div>

                        <!-- Top Source Card -->
                        <div class="bg-white rounded-xl shadow-sm p-6" style="position: absolute; width: 314px; height: 130px; left: 676px; top: 0px; background: #FFFFFF; border: 1px solid #E5E5E5; border-radius: 10px;">
                            <div class="flex justify-between">
                                <div>
                                    <p class="text-sm text-gray-500" style="font-family: 'Raleway'; font-weight: 500; font-size: 18px; line-height: 21px; color: #505050;">Top source</p>
                                    <p class="text-xl font-bold" style="font-family: 'Raleway'; font-weight: 700; font-size: 32px; line-height: 38px; color: #000000;">LinkedIn</p>
                                </div>
                                <div style="position: absolute; width: 65px; height: 65px; right: 20px; top: 32px; background: #10B982; opacity: 0.75; border-radius: 10px; display: flex; align-items: center; justify-content: center;">
                                    <i class="ri-linkedin-box-fill text-white text-2xl"></i>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- Main Content Grid -->
                    <div class="grid grid-cols-3 gap-6" style="position: absolute; width: 980px; height: 610px; left: 20px; top: 170px;">
                        <!-- Left Column (2/3 width) -->
                        <div class="col-span-2">
                            <!-- Recent Activities -->
                            <div class="bg-white rounded-xl shadow-sm p-6" style="position: absolute; width: 632px; height: 610px; left: 0px; top: 0px; background: #FFFFFF; border: 1px solid #E5E5E5; border-radius: 10px;">
                                <div class="flex justify-between items-center mb-6">
                                    <div style="display: flex; align-items: center;">
                                        <div style="width: 50px; height: 50px; background: #10B982; opacity: 0.75; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-right: 20px;">
                                            <i class="ri-history-line text-white text-2xl"></i>
                                        </div>
                                        <div>
                                            <h2 class="text-lg font-semibold text-gray-800" style="font-family: 'Raleway'; font-weight: 600; font-size: 24px; color: #000000;">Recent Activities</h2>
                                            <p class="text-sm text-gray-500" style="font-family: 'Raleway'; font-weight: 400; font-size: 12px; color: #505050;">see all the recent activities in this site</p>
                                        </div>
                                    </div>
                                    <p class="text-sm text-gray-500" style="font-family: 'Raleway'; font-weight: 400; font-size: 12px; color: #505050;">Last 24 hours</p>
                                </div>
                                <div style="width: 100%; height: 1px; background: #D9D9D9; margin-bottom: 20px;"></div>
                                
                                <!-- Activity Items -->
                                <div style="height: 500px; overflow-y: auto;">
                                    <!-- Activity 1 -->
                                    <div class="flex items-start space-x-3 p-3 hover:bg-gray-50 rounded-lg" style="width: 100%; height: 70px; background: #FBFBFB; border-radius: 6px; margin-bottom: 16px;">
                                        <div style="width: 40px; height: 40px; background: rgba(168, 85, 247, 0.75); border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                            <i class="ri-login-circle-line text-white text-xl"></i>
                                        </div>
                                        <div>
                                            <p class="font-medium" style="font-family: 'Raleway'; font-weight: 600; font-size: 16px; color: #000000;">Saron Yirga</p>
                                            <p class="text-sm text-gray-500" style="font-family: 'Raleway'; font-weight: 400; font-size: 12px; color: #505050;">Logged in just now</p>
                                        </div>
                                    </div>

                                    <!-- Activity 2 -->
                                    <div class="flex items-start space-x-3 p-3 hover:bg-gray-50 rounded-lg" style="width: 100%; height: 70px; background: #FBFBFB; border-radius: 6px; margin-bottom: 16px;">
                                        <div style="width: 40px; height: 40px; background: rgba(16, 185, 130, 0.75); border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                            <i class="ri-user-add-line text-white text-xl"></i>
                                        </div>
                                        <div>
                                            <p class="font-medium" style="font-family: 'Raleway'; font-weight: 600; font-size: 16px; color: #000000;">Bereket Henok</p>
                                            <p class="text-sm text-gray-500" style="font-family: 'Raleway'; font-weight: 400; font-size: 12px; color: #505050;">Joined the waiting list 3 minutes ago</p>
                                        </div>
                                    </div>

                                    <!-- Activity 3 -->
                                    <div class="flex items-start space-x-3 p-3 hover:bg-gray-50 rounded-lg" style="width: 100%; height: 70px; background: #FBFBFB; border-radius: 6px; margin-bottom: 16px;">
                                        <div style="width: 40px; height: 40px; background: rgba(16, 185, 130, 0.75); border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                            <i class="ri-user-add-line text-white text-xl"></i>
                                        </div>
                                        <div>
                                            <p class="font-medium" style="font-family: 'Raleway'; font-weight: 600; font-size: 16px; color: #000000;">Abel Ermias</p>
                                            <p class="text-sm text-gray-500" style="font-family: 'Raleway'; font-weight: 400; font-size: 12px; color: #505050;">Joined the waiting list 30 minutes ago</p>
                                        </div>
                                    </div>

                                    <!-- Activity 4 -->
                                    <div class="flex items-start space-x-3 p-3 hover:bg-gray-50 rounded-lg" style="width: 100%; height: 70px; background: #FBFBFB; border-radius: 6px; margin-bottom: 16px;">
                                        <div style="width: 40px; height: 40px; background: rgba(16, 185, 130, 0.75); border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                            <i class="ri-user-add-line text-white text-xl"></i>
                                        </div>
                                        <div>
                                            <p class="font-medium" style="font-family: 'Raleway'; font-weight: 600; font-size: 16px; color: #000000;">Kalab Tewodros</p>
                                            <p class="text-sm text-gray-500" style="font-family: 'Raleway'; font-weight: 400; font-size: 12px; color: #505050;">Joined the waiting list 2 hours ago</p>
                                        </div>
                                    </div>

                                    <!-- Activity 5 -->
                                    <div class="flex items-start space-x-3 p-3 hover:bg-gray-50 rounded-lg" style="width: 100%; height: 70px; background: #FBFBFB; border-radius: 6px;">
                                        <div style="width: 40px; height: 40px; background: rgba(16, 185, 130, 0.75); border-radius: 8px; display: flex; align-items: center; justify-content: center;">
                                            <i class="ri-user-add-line text-white text-xl"></i>
                                        </div>
                                        <div>
                                            <p class="font-medium" style="font-family: 'Raleway'; font-weight: 600; font-size: 16px; color: #000000;">Yishak Tilahun</p>
                                            <p class="text-sm text-gray-500" style="font-family: 'Raleway'; font-weight: 400; font-size: 12px; color: #505050;">Joined the waiting list 5 hours ago</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Right Column (1/3 width) -->
                        <div class="col-span-1">
                            <!-- Quick Actions -->
                            <div class="bg-white rounded-xl shadow-sm p-6" style="position: absolute; width: 316px; height: 342px; left: 664px; top: 0px; background: #FFFFFF; border: 1px solid #E5E5E5; border-radius: 10px;">
                                <div style="display: flex; align-items: center; margin-bottom: 20px;">
                                    <div style="width: 50px; height: 50px; background: #10B982; opacity: 0.75; border-radius: 10px; display: flex; align-items: center; justify-content: center; margin-right: 20px;">
                                        <i class="ri-flashlight-line text-white text-2xl"></i>
                                    </div>
                                    <div>
                                        <h2 class="text-lg font-semibold text-gray-800" style="font-family: 'Raleway'; font-weight: 600; font-size: 24px; color: #000000;">Quick Actions</h2>
                                        <p class="text-sm text-gray-500" style="font-family: 'Raleway'; font-weight: 400; font-size: 12px; color: #505050;">shortcuts to common tasks</p>
                                    </div>
                                </div>
                                <div style="width: 100%; height: 1px; background: #D9D9D9; margin-bottom: 20px;"></div>
                                
                                <!-- Quick Action Buttons -->
                                <div style="display: flex; flex-direction: column; gap: 12px;">
                                    <!-- Quick Action 1 -->
                                    <button class="w-full flex items-center px-4 py-3 bg-white hover:bg-gray-50 text-gray-800 rounded-lg transition-all" style="border: 1px solid #E5E5E5; position: relative;">
                                        <div style="width: 34px; height: 34px; background: #06B6D4; border-radius: 6px; display: flex; align-items: center; justify-content: center; margin-right: 12px;">
                                            <i class="ri-add-line text-white text-lg"></i>
                                        </div>
                                        <span style="font-family: 'Raleway'; font-weight: 400; font-size: 14px; color: #000000;">Create waiting list</span>
                                    </button>

                                    <!-- Quick Action 2 -->
                                    <button class="w-full flex items-center px-4 py-3 bg-white hover:bg-gray-50 text-gray-800 rounded-lg transition-all" style="border: 1px solid #E5E5E5; position: relative;">
                                        <div style="width: 34px; height: 34px; background: #A855F7; border-radius: 6px; display: flex; align-items: center; justify-content: center; margin-right: 12px;">
                                            <i class="ri-user-add-line text-white text-lg"></i>
                                        </div>
                                        <span style="font-family: 'Raleway'; font-weight: 400; font-size: 14px; color: #000000;">Add admin</span>
                                    </button>

                                    <!-- Quick Action 3 -->
                                    <button class="w-full flex items-center px-4 py-3 bg-white hover:bg-gray-50 text-gray-800 rounded-lg transition-all" style="border: 1px solid #E5E5E5; position: relative;">
                                        <div style="width: 34px; height: 34px; background: #10B981; border-radius: 6px; display: flex; align-items: center; justify-content: center; margin-right: 12px;">
                                            <i class="ri-download-line text-white text-lg"></i>
                                        </div>
                                        <span style="font-family: 'Raleway'; font-weight: 400; font-size: 14px; color: #000000;">Download waiting list</span>
                                    </button>

                                    <!-- Quick Action 4 -->
                                    <button class="w-full flex items-center px-4 py-3 bg-white hover:bg-gray-50 text-gray-800 rounded-lg transition-all" style="border: 1px solid #E5E5E5; position: relative;">
                                        <div style="width: 34px; height: 34px; background: #10B981; border-radius: 6px; display: flex; align-items: center; justify-content: center; margin-right: 12px;">
                                            <i class="ri-link text-white text-lg"></i>
                                        </div>
                                        <span style="font-family: 'Raleway'; font-weight: 400; font-size: 14px; color: #000000;">Generate invite link</span>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>

        <!-- Include Remix Icons -->
        <link href="https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css" rel="stylesheet">
        <!-- Include Raleway font -->
        <link href="https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700&display=swap" rel="stylesheet">
        <style>
            body {
                font-family: 'Raleway', sans-serif;
            }
        </style>
    </body>
</x-layout>