<div class="container-fluid mt-2">
  <div class="card">
    <div class="card-header">
      <?= $title; ?>
    </div>
    <div class="card-body">
      
      <div class="row pt-3">
        <div class="col-md-8 offset-2">
          <table class="table">
            <thead>
              <tr>
                <th scope="col">name</th>
                <th scope="col">email</th>
              </tr>
            </thead>
            <tbody>
              <tr>
                <td><?= $userInfo['name']; ?></td>
                <td><?= $userInfo['email']; ?></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>  
    
    </div>
  </div>
</div>