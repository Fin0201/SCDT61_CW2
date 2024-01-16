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

    # Loads the roles page
    driver.find_element(By.XPATH, "/html/body/nav/div/ul/li[4]/a").click()

    # Checks the roles page has been loaded
    assert "Roles Page" in driver.title

    # Clicks on the edit button for the last item in the table
    driver.find_element(By.XPATH, "/html/body/div[1]/table/tbody[2]/tr[last()]/td[4]/form[1]/button").click()

    # Text inputs
    enter_text("/html/body/div[2]/div/div/div[2]/form/div[1]/input", "New name") # Role name

    # Clicks the confirm button
    driver.find_element(By.XPATH, "/html/body/div[2]/div/div/div[2]/form/div[2]/button[1]").click()

    # Checks the page has been reloaded
    assert "Roles Page" in driver.title

    # Waits 60 seconds before closing the chrome tab
    time.sleep(60)


if __name__ == "__main__":
    main()