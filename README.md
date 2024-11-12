# Hotel Blitz
## Business Rule

### 1. **Admin**

- **Properties**:
    - **admin_id**: Unique identifier (auto-generated, mandatory)
    - **email**: Admin's email (must be unique, mandatory)
    - **password**: Admin's login password (mandatory)
      
- **Uniqueness**:
    - Each admin has a **unique email**.
      
- **Relationships**:
    - Admin can **view**, **edit** or **delete** **room**, **facility** and **booking** (one-to-many relationship).

---

### 2. **User**

- **Properties**:
    - **user_id**: Unique identifier (auto-generated, mandatory)
    - **name**: Users’s full name (mandatory)
    - **email**: User's email (must be unique, mandatory)
    - **phone_num**: User's contact number (must be unique, mandatory)
    - **dob**: User's date of birth (mandatory)
    - **password**: User’s login password (mandatory)
      
- **Uniqueness**:
    - **email** and **phone number** must be **unique**.
      
- **Optional/Mandatory**:
    - **name, email, phone_num, and password** are **mandatory** for sign-up.
    - Rating rooms is **optional**.
      
- **Relationships**:
    - A user can have multiple **bookings** (one-to-many relationship).

---

### 3. **Room**

- **Properties**:
    - **room_id**: Unique identifier (auto-generated, mandatory)
    - **room_type**: Type of room (mandatory)
    - **price**: Room's price (mandatory)
    - **description**: Room's description (mandatory)
      
- **Uniqueness**:
    - **room_id** is unique to each room.
      
- **Optional/Mandatory**:
    - **room_id, room_type, price** are **mandatory**.
    - **Facilities** are optional
      
- **Relationships**:
    - A room can have multiple booking(one-to-many relationship).
    - A room can have multiple facilities (one-to-many relationship).

---

### 4. **Booking**

- **Properties**:
    - **booking_id**: Unique identifier (auto-generated, mandatory)
    - **user_id:** A reference to user(mandatory)
    - **room_id:** A reference to room(mandatory)
    - **checkin_date**: Booking date (mandatory)
    - **checkout_date**: End date (mandatory)
    - **amount**: Amount paid by the user (mandatory)
      
- **Uniqueness**:
    - **booking ID** is unique to each booking.
      
- **Optional/Mandatory**:
    - **checkin_date, checkout_date** must be in present or future.
      
- **Relationships**:
    - Each **booking** is associated with **user** and **room** (many-to-one relationship).
    - Each **booking** has single payment(one-to-one relationship).

---

### 5. **Payment**

- **Properties**:
    - **payment_id**: Unique identifier (auto-generated, mandatory)
    - **booking_id**: Reference to the related booking (mandatory)
    - **amount**: Amount paid by the user (mandatory)
    - **details**: Details of the payment (mandatory)
      
- **Uniqueness**:
    - **payment_id** is unique.
      
- **Optional/Mandatory**:
    - All fields are **mandatory**.
      
- **Relationships**:
    - Each payment is tied to one **booking**(one-to-one relationship).
 
 ---

### **6. Facility**

**Properties**:

- **facility_id ID**: Unique identifier for the rating (auto-generated, mandatory)
- **room_id**: Reference to the related room (mandatory)
- **name**: Name of the facility(mandatory)
- **description**: Description of the facilities.(mandatory)

**Uniqueness**:

- **facility_id** is unique.

**Optional/Mandatory**:

- All fields are **mandatory**.

**Relationships**:

- A facility can be associated with multiple **rooms**(many-to-many relationship.



