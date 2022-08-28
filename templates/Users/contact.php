<h2>Contacts</h2>
<button class="btn btn-success" data-toggle="modal" data-target="#contactModal">Add Contact</button>
<div id="contacts"></div>

<!-- The Modal -->
<div class="modal" id="contactModal">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">New Contact</h4>
       <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form id="contactForm">
           <label for="name">Image:</label>
          <input type="hidden" name="add_contact" value="1">
          <div class="mb-3 mt-3">
            <input type="file" class="form-control-file border" name="image" id="image" >
          </div>
          <div class="mb-3 mt-3">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="name2" placeholder="Enter name" name="name">
          </div>
          <div class="mb-3">
            <label for="company">Company:</label>
            <input type="text" class="form-control" id="company" placeholder="Enter company" name="company">
          </div>
          <div class="mb-3">
            <label for="phone">Phone:</label>
            <input type="text" class="form-control" id="phone" placeholder="Enter phone" name="phone">
          </div>
           <div class="mb-3">
            <label for="email">Email:</label>
            <input type="text" class="form-control" id="email2" placeholder="Enter email" name="email">
          </div>
          <button class="btn btn-primary" id="btnAdd" name="btnAdd">Submit</button>
        </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

<!-- The Modal 2 -->
<div class="modal" id="contactModal2">
  <div class="modal-dialog">
    <div class="modal-content">

      <!-- Modal Header -->
      <div class="modal-header">
        <h4 class="modal-title">Edit Contact</h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>

      <!-- Modal body -->
      <div class="modal-body">
        <form id="editContactForm">
          <input type="hidden" name="edit_contact" value="1">
          <input type="hidden" id="contact_id" name="contact_id">
          <img id="imgContact" src="" class="rounded" alt="Cinque Terre" width="304" height="auto">
          <div class="mb-3 mt-3">
            <input type="file" class="form-control-file border" name="image" id="image2" >
          </div> 
          <div class="mb-3 mt-3">
            <label for="name">Name:</label>
            <input type="text" class="form-control" id="c-name" placeholder="Enter name" name="name">
          </div>
          <div class="mb-3">
            <label for="company">Company:</label>
            <input type="text" class="form-control" id="c-company" placeholder="Enter company" name="company">
          </div>
          <div class="mb-3">
            <label for="phone">Phone:</label>
            <input type="text" class="form-control" id="c-phone" placeholder="Enter phone" name="phone">
          </div>
           <div class="mb-3">
            <label for="email">Email:</label>
            <input type="text" class="form-control" id="c-email" placeholder="Enter email" name="email">
          </div>
          <button class="btn btn-primary" id="btnSave" name="btnSave">Save</button>
        </form>
      </div>

      <!-- Modal footer -->
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
      </div>

    </div>
  </div>
</div>

</div>