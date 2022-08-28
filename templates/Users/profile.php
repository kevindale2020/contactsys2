

<div class="container mt-3">
	<div class="col-md-4">
  <h2>Profile</h2>
  <img id="imgProfile" src="" class="rounded-circle" alt="Cinque Terre" width="304" height="auto"> 
  <form id="profileForm">
    <input type="hidden" name="save_profile" value="1">
    <div class="mb-3 mt-3">
      <input type="file" class="form-control-file border" name="image" id="image" >
    </div>
    <div class="mb-3 mt-3">
      <label for="name">Name:</label>
      <input type="text" class="form-control" id="name" placeholder="Enter name" name="name">
    </div>
    <div class="mb-3">
      <label for="email">Email Address:</label>
      <input type="email" class="form-control" id="email" placeholder="Enter email" name="email">
    </div>
    <button class="btn btn-primary" id="btnSave" name="btnSave">Save</button>
  </form>
</div>
</div>
