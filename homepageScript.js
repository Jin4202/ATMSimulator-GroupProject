function confirmAccountDeletion() {
  if (confirm("Are you sure you want to delete your bank account?")) {
    alert("Thank you for deleting your bank account");
    window.location.href = "../index.html";
  }
}
