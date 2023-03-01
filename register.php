<?php include 'header.php' ?>

<body class="g-sidenav-show  bg-gray-100">
  <main class="main-content position-relative max-height-vh-100 h-100 border-radius-lg ">
    <div class="container-fluid py-4">
      <div class="mx-auto text-center">
        <h2>Registration</h2>
      </div>
      <form role="form">
        <!-- <div class="mb-3">
          <label for="emp_code">Code Emp <span class="text-danger">*</span></label>
          <input type="text" class="form-control" placeholder="Code Emp" aria-label="Code Emp" aria-describedby="emp_code-addon" id="emp_code" name="emp_code" value="<?php echo $emp_code; ?>" required>
        </div> -->
        <div class="mb-3">
          <label for="emp_name">Name<span class="text-danger">*</span></label>
          <input type="text" class="form-control" placeholder="Name Emp" aria-label="Name Emp" aria-describedby="emp_name-addon" id="emp_name" name="emp_name" value="<?php echo $emp_name; ?>" required>
        </div>
        <div class="mb-3">
          <label for="emp_surname">Surname<span class="text-danger">*</span></label>
          <input type="text" class="form-control" placeholder="Surname" aria-label="Surname" aria-describedby="surname-addon" id="emp_surname" name="emp_surname" value="" required>
        </div>
        <div class="mb-3">
          <label for="emp_nickname">Nick name<span class="text-danger">*</span></label>
          <input type="text" class="form-control" placeholder="Nick name" aria-label="emp_nickname" aria-describedby="nick_name-addon" id="emp_nickname" name="emp_nickname" value="" required>
        </div>
        <div class="mb-3">
          <label for="emp_position">Position<span class="text-danger">*</span></label>
          <input type="text" class="form-control" placeholder="Position" aria-label="Position" aria-describedby="position-addon" id="emp_position" name="emp_position" value="" required>
        </div>
        <div class="mb-3">
          <label for="emp_agency">Brand Agency<span class="text-danger">*</span></label>
          <!-- <input type="text" class="form-control" placeholder="MB, Initiative, UM, MBCS, BPN, MANGNA, THRIVE, matterkind, REPISE" aria-label="Brand Agency" aria-describedby="brand_agency-addon" id="emp_agency" name="emp_agency" value="" required> -->
          <select name="emp_agency" id="emp_agency" class="form-select" aria-label="Default select example">
            <option value="" selected disabled>Please select brand agency</option>
            <option value="Mediabrands">Mediabrands</option>
            <option value="Initiative">Initiative</option>
            <option value="UM">UM</option>
            <option value="MBCS">MBCS</option>
            <option value="BPN">BPN</option>
            <option value="MANGNA">MANGNA</option>
            <option value="THRIVE">THRIVE</option>
            <option value="matterkind">matterkind</option>
            <option value="REPISE">REPISE</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="emp_mail">Email<span class="text-danger">*</span></label>
          <input type="email" class="form-control" placeholder="Company Email" aria-label="Brand Agency" aria-describedby="mail-addon" id="emp_mail" name="emp_mail" value="" required>
        </div>
        <button type="button" onclick="javascript:submitform()" class="btn bg-gradient-dark w-100 my-4 mb-2">Submit</button>
      </form>
    </div>
  </main>

  <?php include 'footer.php'; ?>

  <script>
    function runApp() {
      liff.getProfile().then(profile => {
        user_id = profile.userId;
        user_displayName = profile.displayName;
        user_pictureUrl = profile.pictureUrl;
        user_statusMessage = profile.statusMessage;
        save_member();
        getData(user_id);
      }).catch(err => console.error(err));
    }

    function getData(userid) {
      $.ajax({
        type: 'POST',
        url: 'get-member.php',
        dataType: "json",
        data: {
          userid: userid
        },
        success: function(data) {
          console.log(data);
          // console.log(data.result.brand_agency);
          if (data.status == 'ok') {
            // $('#emp_code').val(data.result.emp_code);
            $('#emp_name').val(data.result.emp_name);
            $('#emp_surname').val(data.result.emp_surname);
            $('#emp_nickname').val(data.result.emp_nickname);
            $('#emp_mail').val(data.result.member_email);
            $('#emp_position').val(data.result.member_position);
            $('#emp_agency').val(data.result.brand_agency);
          }
        }
      });
    }

    function submitform() {
      if ($('#emp_name').val() != '' && $('#emp_code').val() != '') {


        $.post("save-member.php", {
          userid: user_id,
          // emp_code: $('#emp_code').val(),
          emp_name: $('#emp_name').val(),
          emp_surname: $('#emp_surname').val(),
          emp_nickname: $('#emp_nickname').val(),
          brand_agency: $('#emp_agency').val(),
          member_position: $('#emp_position').val(),
          member_email: $('#emp_mail').val()
        }).done(function(data) {
          console.log('Update ', data);
          const myTimeout = setTimeout(
            function() {
              alert('Register success!');
              window.location.href = 'https://liff.line.me/1657161724-3XJevBEP';
            }, 1000);
        });
      } else {
        alert('กรุณาใส่ให้ครบ');
      }
    }

    function save_member() {
      $.post("mem-register.php", {
          user_id: user_id,
          displayName: user_displayName,
          pictureUrl: user_pictureUrl,
          statusMessage: user_statusMessage
        })
        .done(function(data) {
          console.log('Member', data);
        });
    }

    function closeliff() {
      liff.closeWindow();
    }

    liff.init({
      liffId: "1657161724-ML9kmL7r"
    }, () => {
      if (liff.isLoggedIn()) {
        runApp();
      } else {
        liff.login();
      }
    }, err => console.error(err.code, error.message));
  </script>