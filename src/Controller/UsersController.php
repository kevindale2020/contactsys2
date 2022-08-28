<?php
declare(strict_types=1);

namespace App\Controller;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 * @method \App\Model\Entity\User[]|\Cake\Datasource\ResultSetInterface paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
    /**
     * Index method
     *
     * @return \Cake\Http\Response|null|void Renders view
     */
    public function index() {
       
    }

    public function contact() {

        $this->loadModel('Contacts');

        if($this->request->isAjax()) {

            $contact = $this->Contacts->newEmptyEntity();

            if($this->request->is('post')) {

                if($this->request->getData('add_contact')==1) {

                    $data = $this->request->getData();

                    $image = $this->request->getData('image');

                    $fileName = "";

                    if($image!="") {

                        $fileName = $image->getClientFilename();
                        $fileType = $image->getClientMediaType();

                        if ($fileType == "image/png" || $fileType == "image/jpeg" || $fileType == "image/jpg") {

                            $imagePath = WWW_ROOT . "img/" . $fileName;
                            $image->moveTo($imagePath);
                        }
                    }

                    $data['image'] = $fileName;
                    $data['user_id'] = $this->Auth->user('id');

                    $contact = $this->Contacts->patchEntity($contact, $data);

                    // debug($contact);

                    if($this->Contacts->save($contact)) {

                        $result = json_encode(array('success' => 1, 'message' => 'Successfully added'));

                        return $this->response->withType('json')->withStringBody($result);
                    }
                }

                // get contacts
                if($this->request->getData('get_contacts')==1) {

                    $contacts = $this->Contacts->find('all')->where(['Contacts.user_id' => $this->Auth->user('id')]);

                    $output = '
                         <table class="table table-striped mt-3">
                            <thead>
                              <tr>
                                <th>Image</th>
                                <th>Name</th>
                                <th>Company</th>
                                <th>Phone</th>
                                <th>Email</th>
                                <th>Action</th>
                              </tr>
                            </thead>
                            <tbody>
                    ';

                    foreach($contacts as $contact) {

                        $output.='<tr>';
                        $output.='<td><img src="../img/'.$contact->image.'" width="100" height="100"></td>';
                        $output.='<td>'.$contact->name.'</td>';
                        $output.='<td>'.$contact->company.'</td>';
                        $output.='<td>'.$contact->phone.'</td>';
                        $output.='<td>'.$contact->email.'</td>';
                        $output.='<td><button class="btn btn-primary edit_contact" data-id="'.$contact->id.'" data-image="'.$contact->image.'" data-name="'.$contact->name.'" data-company="'.$contact->company.'" data-phone="'.$contact->phone.'" data-email="'.$contact->email.'">Edit</button> <button class="btn btn-danger delete_contact" data-id="'.$contact->id.'">Delete</button></td>';
                        $output.='</tr>';
                    }

                    $output.='</tbody>';
                    $output.='</table>';

                    $result = json_encode(array('success' => 1, 'results' => $output));

                    return $this->response->withType('json')->withStringBody($result);
                }

            }
        }
    }

    public function profile() {

        if($this->request->isAjax()) {

            if($this->request->is('post')) {

                // $this->loadModel('Users');

                if($this->request->getData('profile')==1) {

                    $id = $this->Auth->user('id');

                    $user = $this->Users->find()
                        ->where(['Users.id' => $id])
                        ->first();

                    $result = json_encode(array('user' => $user));

                    return $this->response->withType('json')->withStringBody($result);

                }

                if($this->request->getData('save_profile')==1) {

                    $id = $this->Auth->user('id');

                    $user = $this->Users->get($id);

                    $current = $this->Users->find()->where(['Users.id' => $id])->first();

                    $image = $this->request->getData('image');

                    $fileName = "";

                    if($image!="") {

                        $fileName = $image->getClientFilename();
                        $fileType = $image->getClientMediaType();

                        if ($fileType == "image/png" || $fileType == "image/jpeg" || $fileType == "image/jpg") {
                            $imagePath = WWW_ROOT . "img/" . $fileName;
                            $image->moveTo($imagePath);
                        }
                    }
                    $user->image = ($fileName!="") ? $fileName : $current['image'];
                    $user->name = $this->request->getData('name');
                    $user->email = $this->request->getData('email');

                    if($this->Users->save($user)) {

                        $result = json_encode(array('success' => 1, 'message' => 'Successfully saved', 'data' => $fileName));

                        return $this->response->withType('json')->withStringBody($result);
                    }
                }
            }
        }

        // $user = $this->Users->find()
    }

    public function edit() {

         $this->loadModel('Contacts');

        if($this->request->isAjax()) {

            if($this->request->is('post')) {

                $id = $this->request->getData('contact_id');

                $contact = $this->Contacts->get($id);

                $current = $this->Contacts->find()->where(['Contacts.id' => $id])->first();

                $image = $this->request->getData('image');

                $fileName = "";

                if($image!="") {

                    $fileName = $image->getClientFilename();
                    $fileType = $image->getClientMediaType();

                    if ($fileType == "image/png" || $fileType == "image/jpeg" || $fileType == "image/jpg") {

                        $imagePath = WWW_ROOT . "img/" . $fileName;
                        $image->moveTo($imagePath);
                    }
                }

                $contact->image = ($fileName!="") ? $fileName : $current['image'];
                $contact->name = $this->request->getData('name');
                $contact->company = $this->request->getData('company');
                $contact->phone = $this->request->getData('phone');
                $contact->email = $this->request->getData('email');

                if($this->Contacts->save($contact)) {

                    $result = json_encode(array('success' => 1, 'message' => 'Successfully updated'));

                    return $this->response->withType('json')->withStringBody($result);
                }
            }
        }
    }

    public function delete() {

         $this->loadModel('Contacts');

        if($this->request->isAjax()) {

            $id = $this->request->getData('delete_id');

            $contact = $this->Contacts->get($id);

            if($this->Contacts->delete($contact)) {

                $result = json_encode(array('success' => 1, 'message' => 'Successfully deleted'));

                return $this->response->withType('json')->withStringBody($result);
            }
        }
    }

    public function test() {

        $this->loadModel('Contacts');

        $contacts = $this->Contacts->find('list')->select(['id', 'name'])->where(['Contacts.user_id' => $this->Auth->user('id')])->toArray();

        $this->set('contacts', $contacts);
    }
}
