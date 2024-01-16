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
    enter_text("/html/body/form/section/div/div/div/div/div/div[1]/input", "admin@test.com") # Email field
    enter_text("/html/body/form/section/div/div/div/div/div/div[2]/input", "P@ssword1") # Password field

    # Clicks the login button
    driver.find_element(By.XPATH, "/html/body/form/section/div/div/div/div/div/button").click()
    
    # Checks the user has been logged in
    assert "Inventory Page" in driver.title

    # Loads the suppliers page
    driver.find_element(By.XPATH, "/html/body/nav/div/ul/li[5]/a").click()

    # Checks the page has been reloaded
    assert "Suppliers Page" in driver.title

    # CLicks on the add category button
    driver.find_element(By.XPATH, "/html/body/div[1]/a").click()

    # Checks the page has been loaded
    assert "Add Supplier" in driver.title

    # Text input
    enter_text("/html/body/form/section/div/div/div/div/div/div[1]/input", "Test supplier") # Supplier name
    enter_text("/html/body/form/section/div/div/div/div/div/div[2]/input", "supplier@test.co.uk") # Supplier email
    enter_text("/html/body/form/section/div/div/div/div/div/div[3]/input", "1234567890") # Supplier phone number

    # Clicks the confirm button
    driver.find_element(By.XPATH, "/html/body/form/section/div/div/div/div/div/button").click()

    # Checks the page has been reloaded
    assert "Suppliers Page" in driver.title

    # Waits 60 seconds before closing the chrome tab
    time.sleep(60)


if __name__ == "__main__":
    main()