## API Routes

### /register

- **Méthode** : POST
- **Tags** : Authentication
- **Résumé** : Register a new user
- **Opération** : register
- **Réponse** :
  - 200 : Successful operation
  - 422 : Validation error

### /login

- **Méthode** : POST
- **Tags** : Authentication
- **Résumé** : Login an existing user
- **Opération** : login
- **Réponse** :
  - 200 : Successful operation
  - 401 : Unauthorized

### /logout

- **Méthode** : POST
- **Tags** : Authentication
- **Résumé** : Logout an existing user
- **Opération** : Logout
- **Réponse** :
  - 200 : Successful operation
  - 401 : Unauthorized

### /token/{id}

- **Méthode** : GET
- **Tags** : Token
- **Résumé** : Get token by ID
- **Opération** : getTokenById
- **Paramètres** :
  - id (path) : ID of the token
- **Réponse** :
  - 200 : Successful operation
  - 404 : Token not found

### /user/{id}

- **Méthode** : GET
- **Tags** : User
- **Résumé** : Get user by ID
- **Opération** : getUserById
- **Paramètres** :
  - id (path) : ID of the user
- **Réponse** :
  - 200 : Successful operation
  - 404 : User not found

### /user/user/edit/{id}

- **Méthode** : GET
- **Tags** : User
- **Résumé** : Edit user by ID
- **Opération** : editUserById
- **Paramètres** :
  - id (path) : ID of the user
- **Réponse** :
  - 200 : Successful operation
  - 404 : User not found

### /user/update/{id}

- **Méthode** : PUT
- **Tags** : User
- **Résumé** : Update user by ID
- **Opération** : updateUserById
- **Paramètres** :
  - id (path) : ID of the user
- **Réponse** :
  - 200 : Successful operation
  - 404 : User not found
  - 422 : Validation error

### /mode/all

- **Méthode** : GET
- **Tags** : Mode
- **Résumé** : Get all modes
- **Opération** : getAllModes
- **Réponse** :
  - 200 : Successful operation

### /mode/add

- **Méthode** : POST
- **Tags** : Mode
- **Résumé** : Add a new mode
- **Opération** : addMode
- **Réponse** :
  - 200 : Mode added successfully
  - 422 : Validation error

### /mode/edit/{id}

- **Méthode** : GET
- **Tags** : Mode
- **Résumé** : Edit mode by ID
- **Opération** : editModeById
- **Paramètres** :
  - id (path) : ID of the mode
- **Réponse** :
  - 200 : Successful operation
  - 404 : Mode not found

### /mode/show/{id}

- **Méthode** : GET
- **Tags** : Mode
- **Résumé** : Show mode by ID
- **Opération** : showModeById
- **Paramètres** :
  - id (path) : ID of the mode
- **Réponse** :
  - 200 : Successful operation
  - 404 : Mode not found

### /mode/update/{id}

- **Méthode** : PUT
- **Tags** : Mode
- **Résumé** : Update mode by ID
- **Opération** : updateModeById
- **Paramètres** :
  - id (path) : ID of the mode
- **Réponse** :
  - 200 : Mode updated successfully
  - 404 : Mode not found
  - 422 : Validation error

### /mode/delete/{id}

- **Méthode** : DELETE
- **Tags** : Mode
- **Résumé** : Delete mode by ID
- **Opération** : deleteModeById
- **Paramètres** :
  - id (path) : ID of the mode
- **Réponse** :
  - 200 : Mode deleted successfully
  - 404 : Mode not found

### /play-game-picolo

- **Méthode** : GET
- **Tags** : Game
- **Résumé** : Play a picolo game
- **Opération** : playPicoloGame
- **Réponse** :
  - 200 : Success

### /create-game

- **Méthode** : POST
- **Tags** : Game
- **Résumé** : Create a new game
- **Opération** : createGame
- **Réponse** :
  - 200 : Game created successfully
  - 422 : Validation error

### /add-player-game

- **Méthode** : PUT
- **Tags** : Game
- **Résumé** : Add a player to the game
- **Opération** : addPlayerToGame
- **Réponse** :
  - 200 : Player added successfully
  - 422 : Validation error

### /game-players/{id}

- **Méthode** : GET
- **Tags** : Game
- **Résumé** : Get players of a specific game
- **Opération** : getPlayersOfGame
- **Paramètres** :
  - id (path) : ID of the game
- **Réponse** :
  - 200 : Successful operation
  - 404 : Game not found

### /game-players

- **Méthode** : POST
- **Tags** : Game
- **Résumé** : Create a new player for a game
- **Opération** : createPlayerForGame
- **Réponse** :
  - 200 : Player created successfully
  - 422 : Validation error

### /msg

- **Méthode** : POST
- **Tags** : Game
- **Résumé** : Send a message
- **Opération** : sendMessage
- **Réponse** :
  - 200 : Message sent successfully
  - 422 : Validation error

### /redirect

- **Méthode** : POST
- **Tags** : Game
- **Résumé** : 
- **Opération** : 
- **Réponse** :
  - 200 : 
  - 422 : 

### /next

- **Méthode** : POST
- **Tags** : Game
- **Résumé** : Go to next round
- **Opération** : next
- **Réponse** :
  - 200 : Success
  - 422 : Validation error
