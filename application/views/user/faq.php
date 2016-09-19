<div class="row">
  <div class="col-xs-12">
    <div class="container">
      <div class="row">
        <h1>FAQ</h1>
      </div>
      <div class="row">
        <button type="button" class="btn btn-primary pull-left" id="webtour" style="margin-left:10px;">Start Web Tour</button>
      </div>
    </div>
  </div>
</div>
<script>
      //Tour Script
        var tour = new Tour({
        storage:false,
        steps: [
        {
          element: "#nav-button",
          title: "Getting Started",
          content: "Click this icon to access all the available menu"
        },
        {
          element: "#submit-button",
          title: "Submitting Report",
          content: "Click this menu to submit the reports which are assigned to you"
        },
        {
          element: "#template-button",
          title: "Seeing Report Template",
          content: "Here you can see, edit, and delete the already existing report templates. You can also create new report template here."
        }
        ,
        {
          element: "#setting-button",
          title: "Profile Setting",
          content: "You can change the detail of your personal profile through this option."
        },
        {
          element: "#service-button",
          title: "Customer Service",
          content: "If you have any inquiries or difficulties regarding our system, you can contact us through our customer service."
        }

      ]});

      // Initialize the tour
      tour.init();

      
      
  </script>