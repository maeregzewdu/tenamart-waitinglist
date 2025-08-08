<template>
  <aside style="position: absolute; width: 240px; height: 800px; left: 0px; top: 0px; background: #FFFFFF; border: 1px solid #E5E5E5;">
    <!-- Logo -->
    <div style="position: absolute; width: 150px; height: 31px; left: 20px; top: 20px;">
      <!-- Logo SVG would go here -->
      <div style="position: absolute; left: 0%; right: 77.46%; top: 0%; bottom: 0%; background: #10B982;"></div>
    </div>

    <!-- Navigation Menu -->
    <nav>
      <ul>
        <sidebar-item 
          to="/general" 
          icon="dashboard-line" 
          text="General"
          :active="true"
          style="position: absolute; width: 200px; height: 48px; left: 20px; top: 95px; background: #F0F0F0; border-radius: 5px;"
          icon-style="left: 12.5%; right: 12.5%; top: 12.5%; bottom: 12.5%; background: #10B982;"
          text-style="left: 69px; top: 112px; width: 44px;"
        />
        <sidebar-item 
          to="/statistics" 
          icon="bar-chart-line" 
          text="Statistics"
          style="position: absolute; width: 200px; height: 48px; left: 20px; top: 163px; background: #FFFFFF; border-radius: 5px;"
          icon-style="left: 12.5%; right: 12.5%; top: 8.33%; bottom: 12.5%; background: #10B982;"
          text-style="left: 69px; top: 180px; width: 50px;"
        />
        <sidebar-item 
          to="/waiting-list" 
          icon="list-check" 
          text="Waiting list"
          style="position: absolute; width: 200px; height: 48px; left: 20px; top: 231px; background: #FFFFFF; border-radius: 5px;"
          icon-style="left: 8.33%; right: 8.33%; top: 8.33%; bottom: 8.33%; background: #10B982;"
          text-style="left: 69px; top: 248px; width: 61px;"
        />
        <sidebar-item 
          to="/admins" 
          icon="user-settings-line" 
          text="Admins"
          style="position: absolute; width: 200px; height: 48px; left: 20px; top: 299px; background: #FFFFFF; border-radius: 5px;"
          icon-style="left: 16.67%; right: 8.33%; top: 4.17%; bottom: 8.33%; background: #10B982;"
          text-style="left: 69px; top: 316px; width: 42px;"
        />
        <sidebar-item 
          to="/profile-settings" 
          icon="settings-3-line" 
          text="Profile settings"
          style="position: absolute; width: 200px; height: 48px; left: 20px; top: 367px; background: #FFFFFF; border-radius: 5px;"
          icon-style="left: 16.67%; right: 6.68%; top: 4.17%; bottom: 6.25%; background: #10B982;"
          text-style="left: 69px; top: 384px; width: 82px;"
        />
      </ul>

      <!-- User Menu -->
      <div style="position: absolute; width: 200px; height: 202px; left: 20px; top: 486px; background: #FFFFFF; border: 1px solid #E5E5E5; border-radius: 5px;">
        <sidebar-item 
          to="/profile-settings" 
          icon="user-settings-line" 
          text="Profile Settings"
          style="position: absolute; width: 172px; height: 48px; left: 34px; top: 500px; background: #FFFFFF; border-radius: 5px;"
          icon-style="left: 16.67%; right: 6.68%; top: 4.17%; bottom: 6.25%; background: #10B982;"
          text-style="left: 83px; top: 517px; width: 84px; color: #000000;"
        />
        <div style="position: absolute; width: 172px; height: 0px; left: 34px; top: 558px; border: 1px solid #F0F0F0;"></div>
        <sidebar-item 
          to="/logout" 
          icon="logout-box-r-line" 
          text="Log out"
          style="position: absolute; width: 172px; height: 48px; left: 34px; top: 568px; background: #FFFFFF; border-radius: 5px;"
          icon-style="left: 16.67%; right: 4.17%; top: 8.33%; bottom: 8.33%; background: #E32F2F;"
          text-style="left: 83px; top: 585px; width: 43px; color: #E32F2F;"
        />
        <sidebar-item 
          to="/delete-account" 
          icon="delete-bin-line" 
          text="Delete account"
          style="position: absolute; width: 172px; height: 48px; left: 34px; top: 626px; background: #FFFFFF; border-radius: 5px;"
          icon-style="left: 8.33%; right: 8.33%; top: 8.33%; bottom: 8.33%; background: #E32F2F;"
          text-style="left: 83px; top: 643px; width: 85px; color: #E32F2F;"
        />
      </div>
    </nav>

    <!-- User Profile -->
    <div style="position: absolute; width: 200px; height: 72px; left: 20px; top: 708px; background: #F0F0F0; border-radius: 5px;">
      <div style="position: absolute; width: 40px; height: 40px; left: 36px; top: 724px; background: #10B982; border-radius: 20px;">
        <span style="position: absolute; width: 10px; height: 19px; left: 15px; top: 10px; font-family: 'Raleway'; font-weight: 700; font-size: 16px; line-height: 19px; color: #FFFFFF;">S</span>
      </div>
      <div style="position: absolute; width: 75px; height: 16px; left: 86px; top: 727px; font-family: 'Raleway'; font-weight: 500; font-size: 14px; line-height: 16px; color: #000000;">Saron Yirga</div>
      <div style="position: absolute; width: 84px; height: 14px; left: 86px; top: 746px; font-family: 'Raleway'; font-weight: 500; font-size: 12px; line-height: 14px; color: #000000;">saronyirga@g...</div>
      <div style="position: absolute; width: 20px; height: 20px; left: 180px; top: 734px;">
        <div style="position: absolute; left: 24.14%; right: 24.14%; top: 11.82%; bottom: 11.82%; background: #505050;"></div>
      </div>
    </div>
  </aside>
</template>

<script>
import SidebarItem from './SidebarItem.vue';

export default {
  name: 'Sidebar',
  components: {
    SidebarItem
  }
}
</script>

<style>
@import url('https://fonts.googleapis.com/css2?family=Raleway:wght@400;500;600;700&display=swap');
@import url('https://cdn.jsdelivr.net/npm/remixicon@3.5.0/fonts/remixicon.css');

body {
  font-family: 'Raleway', sans-serif;
}
</style>