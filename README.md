## PizzaWeb

### 1. Felhasználói Dokumentáció

#### 1.1. Menük
- **PizzaWeb** -> Kezdőoldal, általános információk
- **Pizzák** -> Választható pizzák listája
- **Kapcsolat** -> Céginformációk, üzenetküldés, telephely
- **Kosár** -> Kosárba tett pizzák darabszáma és a kosár összege

#### 1.2. Pizzák Kiválasztása
##### 1.2.1. Keresés
- Keresés pizza név alapján.
- Sorrend kiválasztása név, népszerűség, ár szerint növekvő vagy csökkenő sorrendben.

##### 1.2.2. Méret Kiválasztása
- Méretválasztás egy lenyíló menüből.
- Az első verzióban csak egy méret kerül rögzítésre, de több méret is választható.

##### 1.2.3. Mennyiség Megadása
- A mennyiség közvetlen beírható vagy a mezőben lévő nyilakkal módosítható.

##### 1.2.4. Kosárba Tétel
- Kosárba helyezéskor, ha már létezik a termék a kosárban, egy felugró ablak rákérdez a hozzáadás megerősítésére.

#### 1.3. Kosár
- A kosár tartalmát a fejlécben található kosár ikonra kattintva lehet elérni.
- Rendelési adatokat a megrendelés leadása előtt lehet megadni.
- Sikeres megrendelés után egy értesítés jelenik meg.

#### 1.4. Üzenetküldés
- Üzenet küldése email megadása után.

### 2. Fejlesztői Dokumentáció

#### 2.1. API Működése
- **GET Pizzák**: `get-pizzas` - Opciós szűrés, lapozás.
- **Kosár Információ**: `get-basketInfo` - Pizzák listája, mennyiség és kosár érték.
- **Megrendelés Regisztrálása**: `post-sendOrder` - Megrendelő adatai és pizzák ID, mennyiség alapján.
- **Üzenetküldés**: `post-sendMessage`.

#### 2.2. React Leírása
- **Kosár Tartalmának Kezelése**: A kosár tartalmát Cookie-ben tároljuk, API használatával.
- **Mennyiség Módosítása**: `quantities` állapotban tároljuk, `handleQuantityChange`-el frissítjük.
- **Felugró Ablakok**: Modal ablakokat használunk megerősítésekre.
- **Pizza Lista és Lapozás**: Rendezési szempontok alapján API-val történik a lekérdezés.
- **Megrendelés Elküldése**: A kosár tartalmának ID és mennyiség adatokat küldi.
