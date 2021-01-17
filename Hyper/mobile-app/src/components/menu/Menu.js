import React, { useState } from "react";
import styles from "./index.module.scss";
import { Navbar, Nav } from "react-bootstrap";
import weekplanning from "../../assets/img/icons/weekplanning.svg";
import beschikbaarheid from "../../assets/img/icons/beschikbaarheid.svg";
import score from "../../assets/img/icons/score.svg";
// import afvallers from "../../assets/img/icons/afvallers.svg";
import salaris from "../../assets/img/icons/salaris.svg";
import declaraties from "../../assets/img/icons/declaraties.svg";
import vriendAanmelden from "../../assets/img/icons/vriendAanmelden.svg";
import instellingen from "../../assets/img/icons/instellingen.svg";
import uitloggen from "../../assets/img/icons/uitloggen.svg";
import x from "../../assets/img/icons/X.svg";
import logoWhite from "../../assets/img/branding/logo-white.svg";
import menuIcon from "../../assets/img/icons/menu-icon.svg";
import { BrowserRouter as Router } from "react-router-dom";
import { connect } from "react-redux";
import { signOut } from "../../actions/userActions";


const Menu = ({ signOut }) => {
  const [expanded, setExpanded] = useState(false);
  const [show] = useState(false);
  return (
    <div>
      <Router>
        <Navbar
          expanded={expanded}
          expand="xxl"
          className="navContainer"
          style={{
            width: "100%",
            padding: "0px",
            position: "absolute",
            left: "0",
            top: "0",
            zIndex: "999"
          }}
        >
          {!show && (
            <Navbar.Toggle
              aria-controls="basic-navbar-nav"
              //   onClick={() => setShow(!show)}
              onClick={() => setExpanded(!expanded)}
              className={styles.menuIcon}
              style={
                !expanded
                  ? {
                    backgroundImage: `url(${menuIcon})`
                  }
                  : null
              }
            />
          )}
          <Navbar.Collapse id="basic-navbar-nav">
            <Nav className={styles.menuContainer}>
              <div className={styles.menuHeader}>
                <img className={styles.logo} src={logoWhite} alt="logo" />
                <img
                  onClick={() => setExpanded(false)}
                  className={styles.x}
                  src={x}
                  alt="x"
                />
              </div>
              <Nav.Link className={styles.menuItem} href="WeekPlanning">
                Weekplanning
                <img className={styles.menuImg} alt="" src={weekplanning} />
              </Nav.Link>
              <Nav.Link className={styles.menuItem} href="Beschikbaarheid">
                Beschikbaarheid
                <img className={styles.menuImg} alt="" src={beschikbaarheid} />
              </Nav.Link>
              <Nav.Link className={styles.menuItem} href="Score">
                Score
                <img className={styles.menuImg} alt="" src={score} />
              </Nav.Link>
              {/* <Nav.Link className={styles.menuItem} href="Afvallers">
                Afvallers
                <img className={styles.menuImg} alt="" src={afvallers} />
              </Nav.Link> */}
              <Nav.Link className={styles.menuItem} href="Salaris">
                Salaris
                <img className={styles.menuImg} alt="" src={salaris} />
              </Nav.Link>
              <Nav.Link className={styles.menuItem} href="Declaraties">
                Declaraties
                <img className={styles.menuImg} alt="" src={declaraties} />
              </Nav.Link>
              <Nav.Link className={styles.menuItem} href="VriendAanmelden">
                Vriend aanmelden
                <img className={styles.menuImg} alt="" src={vriendAanmelden} />
              </Nav.Link>
              <div style={{ marginTop: "25px" }}>
                <Nav.Link className={styles.menuItem} href="Instellingen">
                  Instellingen
                  <img className={styles.menuImg} alt="" src={instellingen} />
                </Nav.Link>
                <Nav.Link
                  className={styles.menuItem}
                  href="#"
                  onClick={() => signOut()}
                >
                  Uitloggen
                  <img className={styles.menuImg} alt="" src={uitloggen} />
                </Nav.Link>
              </div>
            </Nav>
          </Navbar.Collapse>
        </Navbar>
      </Router>
    </div>
  );
};

export default connect(null, { signOut })(Menu);
