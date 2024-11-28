document.addEventListener("DOMContentLoaded", () => {
  const form1 = document.getElementById("patient-form1");
  const form2 = document.getElementById("patient-form2");

  const showError = (input, message) => {
    const errorElement = input.nextElementSibling;
    if (errorElement && errorElement.classList.contains("error-message")) {
      errorElement.textContent = message;
    } else {
      const errorSpan = document.createElement("span");
      errorSpan.classList.add("error-message");
      errorSpan.textContent = message;
      input.parentNode.appendChild(errorSpan);
    }
    input.classList.add("error");
  };

  const clearError = (input) => {
    const errorElement = input.nextElementSibling;
    if (errorElement && errorElement.classList.contains("error-message")) {
      errorElement.remove();
    }
    input.classList.remove("error");
  };

  if (form1) {
    form1.addEventListener("submit", (e) => {
      let isValid = true;

      const firstName = document.getElementById("first_name");
      const lastName = document.getElementById("last_name");
      const password = document.getElementById("password");
      const nic = document.getElementById("nic");
      const dob = document.getElementById("dob");
      const address = document.getElementById("address");
      const email = document.getElementById("email");
      const contact = document.getElementById("contact");
      const genderSelected = document.querySelector(
        'input[name="gender"]:checked'
      );

      // First Name validation
      if (!firstName.value.trim()) {
        showError(firstName, "First Name is required.");
        isValid = false;
      } else {
        clearError(firstName);
      }

      // Last Name validation
      if (!lastName.value.trim()) {
        showError(lastName, "Last Name is required.");
        isValid = false;
      } else {
        clearError(lastName);
      }

      // Password validation (minimum 6 characters)
      if (password.value.trim().length < 6) {
        showError(password, "Password must be at least 6 characters long.");
        isValid = false;
      } else {
        clearError(password);
      }

      // NIC validation
      if (!/^\d{9}[vxVX]$|^\d{12}$/.test(nic.value.trim())) {
        showError(
          nic,
          "NIC must be valid (9 digits followed by 'v/V/x/X' or 12 digits)."
        );
        isValid = false;
      } else {
        clearError(nic);
      }

      // Date of Birth validation
      // Date of Birth validation
      if (!dob.value.trim()) {
        showError(dob, "Date of Birth is required.");
        isValid = false;
      } else {
        const enteredDate = new Date(dob.value.trim());
        const currentDate = new Date();
        const minAllowedDate = new Date();
        minAllowedDate.setFullYear(currentDate.getFullYear() - 16);

        if (isNaN(enteredDate.getTime()) || enteredDate > minAllowedDate) {
          showError(dob, "You must be at least 16 years old.");
          isValid = false;
        } else {
          clearError(dob);
        }
      }

      // Gender validation
      if (!genderSelected) {
        showError(
          document.querySelector('input[name="gender"]'),
          "Gender must be selected."
        );
        isValid = false;
      } else {
        clearError(document.querySelector('input[name="gender"]'));
      }

      // Address validation
      if (!address.value.trim()) {
        showError(address, "Address is required.");
        isValid = false;
      } else {
        clearError(address);
      }

      // Email validation
      if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email.value.trim())) {
        showError(email, "Email Address is invalid.");
        isValid = false;
      } else {
        clearError(email);
      }

      // Contact Number validation
      if (!/^\d{10}$/.test(contact.value.trim())) {
        showError(contact, "Contact number must be 10 digits.");
        isValid = false;
      } else {
        clearError(contact);
      }

      if (!isValid) e.preventDefault();
    });
  }

  if (form2) {
    form2.addEventListener("submit", (e) => {
      let isValid = true;

      const emergencyContactName = document.getElementById(
        "emergency_contact_name"
      );
      const emergencyContactNo = document.getElementById(
        "emergency_contact_no"
      );
      const emergencyContactRelationship = document.getElementById(
        "emergency_contact_relationship"
      );
      const allergies = document.getElementById("allergies");
      const medicalConditions = document.getElementById("medical_conditions");

      // Emergency Contact Name validation
      if (!emergencyContactName.value.trim()) {
        showError(emergencyContactName, "Emergency Contact Name is required.");
        isValid = false;
      } else {
        clearError(emergencyContactName);
      }

      // Emergency Contact Number validation
      if (!/^\d{10}$/.test(emergencyContactNo.value.trim())) {
        showError(
          emergencyContactNo,
          "Emergency Contact Number must be 10 digits."
        );
        isValid = false;
      } else {
        clearError(emergencyContactNo);
      }

      // Emergency Contact Relationship validation
      if (!emergencyContactRelationship.value.trim()) {
        showError(
          emergencyContactRelationship,
          "Emergency Contact Relationship is required."
        );
        isValid = false;
      } else {
        clearError(emergencyContactRelationship);
      }

      // Allergies validation (optional, but sanitize input)
      if (allergies.value.trim() && allergies.value.trim().length > 500) {
        showError(
          allergies,
          "Allergies information must be less than 500 characters."
        );
        isValid = false;
      } else {
        clearError(allergies);
      }

      // Medical Conditions validation (optional, but sanitize input)
      if (
        medicalConditions.value.trim() &&
        medicalConditions.value.trim().length > 500
      ) {
        showError(
          medicalConditions,
          "Medical conditions information must be less than 500 characters."
        );
        isValid = false;
      } else {
        clearError(medicalConditions);
      }

      if (!isValid) e.preventDefault();
    });
  }
});
