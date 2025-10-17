  <?php
  public function validUsername($userName) {
            $names = $this->processUserNames(); 
            $isValid = true; 

            foreach ($names as $name) {
                if ($name["name"] === $userName) {
                    $isValid = false;
                    break;
                }
            }
            return $isValid;
        }

        public function validEmail($userEmail) {
            $emails = $this->processUserEmails(); 
            $isValid = true; 

            foreach ($emails as $email) {
                if ($email["email"] === $userEmail) {
                    $isValid = false;
                    break;
                }
            }
            return $isValid;
        }

        public function successfulRegistration($userName, $userEmail, $userPassword, $img) {
            $hash = password_hash($userPassword, PASSWORD_DEFAULT);
            $registration = $this->dbConnection->prepare('INSERT INTO users (`name`, `email`, `password`, `photoProfile`) VALUES (:name, :email, :password, :photoProfile)');
        
            $registration->execute(array(
                ":name" => $userName,
                ":email" => $userEmail,
                ":password" => $hash,
                ":photoProfile" => $img
            ));
        }        

        public function passwordVerify($userName,$userPassword) {
            $dataUsers = $this->processUserData();
            $successfulLogin = false;
            
            foreach ($dataUsers as $dataUser) {
                if (($dataUser["name"] === $userName) && (password_verify($userPassword, $dataUser["password"]))) {
                    $successfulLogin = true; 
                    $this ->sessionData [] = [ 
                                    $dataUser ["idUser"],
                                    $dataUser["name"],
                                    $dataUser["email"],
                                    $dataUser["photoProfile"]
                                    ]; 
                    break;
                }
            }

            return $successfulLogin;
        }
?>