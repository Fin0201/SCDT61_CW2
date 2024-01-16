from selenium import webdriver
from selenium.webdriver.common.by import By
import time

# Sets the Selenium webdriver to Chrome
driver = webdriver.Chrome()

# Function used to enter text into an input field
def enter_text(input_xpath, new_text):
    # Find Element by XPATH
    input = driver.find_element(By.XPATH, input_xpath)

    # Clears the input. Necessary if there is already text in the input
    input.clear()

    # Enter text into the element
    input.send_keys(new_text)


def main():
    # Load Webpage
    driver.get("http://localhost/SCDT61_CW2/")

    # Check the correct page has been loaded
    assert "Home" in driver.title

    # Clicks on the login navbar button
    driver.find_element(By.XPATH, "/html/body/nav/div/ul/li[8]/a").click()

    # Checks the register page has been loaded
    assert "Login Page" in driver.title

    # Enters text into the login form
    login_email = "admin@test.com"
    login_password = "P@ssword1"
    enter_text("/html/body/form/section/div/div/div/div/div/div[1]/input", login_email) # Email field
    enter_text("/html/body/form/section/div/div/div/div/div/div[2]/input", login_password) # Password field

    # Clicks the login button
    driver.find_element(By.XPATH, "/html/body/form/section/div/div/div/div/div/button").click()
    
    # Checks the user has been logged in
    assert "Inventory Page" in driver.title

    # Loads the suppliers page
    driver.find_element(By.XPATH, "/html/body/nav/div/ul/li[5]/a").click()

    # Checks the page has been loaded
    assert "Suppliers Page" in driver.title

    # Clicks on the edit button for the last item in the table
    driver.find_element(By.XPATH, "/html/body/div[1]/table/tbody[2]/tr[last()]/td[6]/form[1]/button").click()

    # Text input
    supplier_name = "New supplier name"
    supplier_email = "newemail@test.co.uk"
    supplier_phone_number = "1324576809"
    enter_text("/html/body/div[2]/div/div/div[2]/form/div[1]/input", supplier_name) # Supplier name
    enter_text("/html/body/div[2]/div/div/div[2]/form/div[2]/input", supplier_email) # Supplier email
    enter_text("/html/body/div[2]/div/div/div[2]/form/div[3]/input", supplier_phone_number) # Supplier phone number

    # Clicks the confirm button
    driver.find_element(By.XPATH, "/html/body/div[2]/div/div/div[2]/form/div[4]/button[1]").click()

    # Checks the page has been reloaded
    assert "Suppliers Page" in driver.title

    # Waits 60 seconds before closing the chrome tab
    time.sleep(60)


if __name__ == "__main__":
    main()