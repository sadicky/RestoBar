<li class="nav-item">
            <a  class="nav-link text-white" href="javascript:void(0)" id="client_ord">
              Vente
             </a>
       </li>
       <li class="nav-item">
            <a  class="nav-link text-white" href="javascript:void(0)" id="transact_jour">
             Transactions
             </a>
       </li>
       <li class="nav-item">
            <a  class="nav-link text-white" href="javascript:void(0)" id="open_day">
              <?php
          if(isset($_SESSION['jour']))
          {
            echo 'Cloturer le Journal';
          }
          else
          {
            ?>
             Ouvrir le Journal
          <?php
          }
          ?>
             </a>
       </li>

