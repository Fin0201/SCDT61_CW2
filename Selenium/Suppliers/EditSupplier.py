from selenium import webdriver
from selenium.webdriver.common.by import By
from selenium.webdriver.support.ui import Select
import time

# Sets the Selenium webdriver to Chrome
driver = webdriver.Chrome()

# Function used to click on HTML elements
def click_element(input_xpath):
    # Find Element by XPATH
    element = driver.find_element(By.XPATH, input_xpath)

    # Click Element
    element.click()


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
    click_element("/html/body/nav/div/ul/li[8]/a")

    # Checks the register page has been loaded
    assert "Login Page" in driver.title

    # Enters text into the login form
    enter_text("/html/body/form/section/div/div/div/div/div/div[1]/input", "admin@test.com") # Email field
    enter_text("/html/body/form/section/div/div/div/div/div/div[2]/input", "P@ssword1") # Password field

    # Clicks the login button
    click_element("/html/body/form/section/div/div/div/div/div/button")
    
    # Checks the user has been logged in
    assert "Inventory Page" in driver.title

    # Loads the suppliers page
    click_element("/html/body/nav/div/ul/li[5]/a")

    # Checks the page has been loaded
    assert "Suppliers Page" in driver.title

    # Clicks on the edit button for the third item in the table
    click_element("/html/body/div[1]/table/tbody[2]/tr[3]/td[6]/form[1]/button")

    # Text input
    enter_text("/html/body/div[2]/div/div/div[2]/form/div[1]/input", "New name") # Supplier name
    enter_text("/html/body/div[2]/div/div/div[2]/form/div[2]/input", "newemail@test.co.uk") # Supplier email
    enter_text("/html/body/div[2]/div/div/div[2]/form/div[3]/input", "1324576809") # Supplier phone number

    # Clicks the confirm button
    click_element("/html/body/div[2]/div/div/div[2]/form/div[4]/button[1]")

    # Checks the page has been reloaded
    assert "Suppliers Page" in driver.title

    # Waits 60 seconds before closing the chrome tab
    time.sleep(60)


if __name__ == "__main__":
    main()