<?php
require_once 'header.php';
require_once '/filters/loginfilter.php';
?>
<div class="container-center" >
    <div class="wrapper">
    <h2>Contacts</h2>
        
        <table>
            <thead>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Phone Number</th>
                <th></th>
            </thead>
        
        
        <?php
        require_once '/repositories/contacts_repository.php';
        
        $contactsRep = new ContactsRepository();
        
        if ($_SESSION["LoggedUserIsAdmin"]):
            $contacts = $contactsRep->getAll();
        else:
            $contacts = $contactsRep->getAllByUserId($_SESSION["LoggedUserId"]);
        endif;
        
        foreach ($contacts as $c) :
            ?>
            
            <tbody>
                <tr>
                    <td><?= $c->getFirst_name()?></td>
                    <td><?= $c->getLast_name()?></td>
                    <td><?= $c->getPhone_number()?></td>
                    <td><a href="edit_contact.php?id=<?= $c->getId(); ?>">Edit</a></td>
                    <td><a href="delete_contact.php?id=<?= $c->getId(); ?>">Delete</a></td>
                </tr>
            </tbody>
            
        <?php
        endforeach;
        ?>
        
        </table>
        
    <a href="add_contact.php" class="left-aligned">Add Contact</a>
    </div>
</div>

<?php
require_once 'footer.php';
?>



